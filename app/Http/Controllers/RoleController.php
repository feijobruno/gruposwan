<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Listar os papéis
    public function index()
    {
        
        // Recuperar os registros do banco dados
        $roles = Role::orderBy('id')->paginate(10);

        // Salvar log
        Log::info('Lista las funciones', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('roles.index', ['menu' => 'roles', 'roles' => $roles]);

    }

    // Carregar o formulário cadastrar novo papel
    public function create()
    {

        // Salvar log
        Log::info('Cargar formulario de registro función.', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('roles.create', [
            'menu' => 'roles',
        ]);
    }

    // Cadastrar no banco de dados o novo papel
    public function store(RoleRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Cadastrar no banco de dados
            $role = Role::create([
                'name' => $request->name,
            ]);

            // Salvar log
            Log::info('Papel cadastrado.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('role.index')->with('success', '¡Función registrado exitosamente!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Función no registrado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Función no registrado.');
        }
    }

    // Carregar o formulário editar papel
    public function edit(Role $role)
    {

        // Salvar log
        Log::info('Carregar formulário editar papel.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('roles.edit', [
            'menu' => 'roles',
            'role' => $role,
        ]);
    }

    // Editar no banco de dados o usuário
    public function update(RoleRequest $request, Role $role)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $role->update([
                'name' => $request->name,
            ]);

            // Salvar log
            Log::info('Papel editado.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('role.index')->with('success', '¡Papel editado con éxito!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Papel não editado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Papel sin editar!');
        }
    }

    // Excluir o papel do banco de dados
    public function destroy(Role $role)
    {
        if ($role->name == 'Super Admin') {
            // Salvar log
            Log::warning('La función de superadministrador no se puede eliminar.', ['papel_id' => $role->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('role.index')->with('error', '¡La función de superadministrador no se puede eliminar!');
        }

        // Não permitir excluir papel quando tem algum usuário utilizando o papel
        if ($role->users->isNotEmpty()) {
            // Salvar log
            Log::warning('El papel no se puede eliminar porque hay usuarios asociados.', ['papel_id' => $role->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('role.index')->with('error', 'La función no se puede eliminar porque hay usuarios asociados a él.');
        }

        try {
            // Excluir o registro do banco de dados
            $role->delete();

            // Salvar log
            Log::info('Papel excluído.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('role.index')->with('success', '¡El documento se eliminó correctamente!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Papel no excluido.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('role.index')->with('error', '¡Función no excluido!');
        }
    }
}
