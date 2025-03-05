<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductFile;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    // Listar os cursos
    public function index( Request $request )
    {
        $data = DB::table('products')
                    ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
                    ->select('products.id','products.product', 'products.packaging_type','products.kg','products.kg_pallet','products.qty_pallet', 'products.dangerous_material', 'products.supplier_id','suppliers.supplier')
                    ->get();
        // $data = Product::get();
       
        // Carregar a VIEW
        return view('products.index', [
            'menu' => 'products', 
            'data' => $data,
        ]);
    }

    public function create()
    {

        $suppliers = Supplier::get();
        // Carregar a VIEW
        return view('products.create', ['menu' => 'products', 'suppliers' => $suppliers]);
    }

    // Cadastrar no banco de dados o novo curso
    public function store(ProductRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
            $product = Product::create([
                'product' => $request->product,
                'supplier_id' => $request->supplier_id,
                'weight' => $request->weight,
                'qty_pallet' => $request->qty_pallet,
                'weight_pallet' => $request->weight_pallet,
                'dangerous_material' => $request->dangerous_material,
                'packaging_type' => $request->packaging_type,
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Salvar log
            Log::info('Producto registrado.', [ 'product_id' => $product->id, 'supplier_id' => $product->supplier_id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('product.index', ['product' => $product->id])->with('success', '¡Producto registrado exitosamente!');
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Salvar log
            Log::notice('Producto no registrado.', [ 'error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Producto no registrado!');
        }
    }

    // Carregar o formulário editar curso
    public function edit(Product $product)
    {
        $suppliers = Supplier::get();

        // Load the VIEW
        return view('products.edit', ['menu' => 'products', 'product' => $product, 'suppliers' => $suppliers]);
    }

    // Edit in database
    public function update(ProductRequest $request, Product $product)
    {

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Validar o formulário
            $request->validated();

            // Editar as informações do registro no banco de dados
            $product->update([
                'product' => $request->product,
                'supplier_id' => $request->supplier_id,
                'kg' => $request->kg,
                'qty_pallet' => $request->qty_pallet,
                'kg_pallet' => $request->kg_pallet,
                'dangerous_material' => $request->dangerous_material,
                'packaging_type' => $request->packaging_type,
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Salvar log
            Log::info('Producto editado.', [ 'product_id' => $product->id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('product.index', ['product' => $product->id])->with('success', '¡Producto editado exitosamente!');
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Salvar log
            Log::notice('Producto sin editar', [ 'error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Producto sin editar!');
        }
    }

    // Excluir o curso do banco de dados
    public function destroy(Product $product)
    {

        try {

            // Excluir o registro do banco de dados
            $product->delete();

            // Salvar log
            Log::info('Producto apagado.', [ 'product_id' => $product->id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('product.index')->with('success', '¡Producto eliminado exitosamente!');
        } catch (Exception $e) {

            // Salvar log
            Log::notice('Produto não apagado.', [ 'error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('product.index')->with('error', '¡Producto no eliminado!');
        }
    }

    public function document(Product $product)
    {
        $data = ProductFile::where('product_id', $product->id)->where('type', '<>', 'Technical')->get();
               
         // Load the VIEW
         return view('products.document', ['menu' => 'commercial', 'product' => $product, 'data' => $data ]);
    }

    public function technical(Product $product)
    {
        $data = ProductFile::where('product_id', $product->id)->where('type', 'Technical')->get();
               
         // Load the VIEW
         return view('products.technical', ['menu' => 'commercial', 'product' => $product, 'data' => $data ]);
    }

    public function metting(Product $product)
    {
        $mettings = $product->mettings;

        // Load the VIEW
        return view('products.metting', ['menu' => 'commercial', 'mettings' => $mettings, 'product' => $product ]);
    }

    public function presentation(Product $product)
    {
        $presentations = $product->presentations;

         // Load the VIEW
        return view('products.presentation', ['menu' => 'commercial', 'presentations' => $presentations, 'product' => $product ]);
    }

}
