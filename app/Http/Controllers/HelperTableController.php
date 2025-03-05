<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HelperTableController extends Controller
{

    // Detalhes do perfil
    public function index()
    {
        // Recuperar do banco de dados as informações do usuário logado
        $data = Country::orderBy('status', 'DESC')->orderBy('country', 'ASC')->get();

        // Carregar a VIEW
        return view('helperTables.index', ['data' => $data]);
    }

    // Carregar o formulário editar perfil
    public function update(Request $request)
    {
        // Recuperar do banco de dados as informações do usuário logado
        $country = Country::where('country', $request->country)->first();
        DB::beginTransaction();
        

        if($country->status == 1){
            DB::table('countries')
            ->where('country', $request->country )
            ->update(['status' => 0]);
        }else{
            DB::table('countries')
            ->where('country', $request->country )
            ->update(['status' => 1]);
        }

        DB::commit();
    
        $data = Country::orderBy('status', 'DESC')->orderBy('country', 'ASC')->get();
        // Carregar a VIEW
        return redirect()->route('helperTables.index', ['data' => $data])->with('success', 'País editado exitosamente.'); 
    }

}
