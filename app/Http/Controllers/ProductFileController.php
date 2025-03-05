<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductFileController extends Controller
{

    public function create( Product $product )
    {     
        // Carregar a VIEW
        return view('productFiles.create', [
            'menu' => 'products',
            'product' => $product 
        ]);
    }

    public function store(Request $request)
    {
        // Validate the form
        //$request->validate();     
        
        // Send File
        if($request->hasFile('file') && $request->file('file')->isValid()){
	
            $requestFile = $request->file('file');
            $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
            
            // Upload File
            $fileName = date('YmdHi').'-'.$fileName;
            $requestFile->move(public_path("/files/product_file/"), $fileName);
        }else{
            $fileName = null;
        }

        try {
            
            DB::beginTransaction();

                // Register the values of all fields in the database in the table.
                $product = Product::where('id', $request->product_id)->first();
                $productDocument = ProductFile::create([
                    'product' => $product->product,
                    'product_id' => $product->id,
                    'name' => $request->name,
                    'type' => $request->type,
                    'year' => date('Y'),
                    'file' => $fileName
                ]);                    
            // Operação é concluída com êxito
            DB::commit();

            if($request->type == 'Technical') {
                return redirect()->route('product.technical', ['product' => $product->id ])->with('success', 'Documento registrado exitosamente!');
            }else{
                return redirect()->route('product.document', ['product' => $product->id ])->with('danger', '¡Documento registrada exitosamente!');
            } 

           
        } catch (Exception $e) {
            
            // Operation does not complete successfully
            DB::rollBack();
            //Redirect user, send error message
            return back()->withInput()->with('error', '¡Documento no registrado!');
            
        } 

    }

    // Carregar o formulário editar curso
    public function edit(ProductFile $file)
    {
        $productDocument = ProductFile::where('id', $file->id)->first();
        //dd('ProductDocument Edit: ',$productDocument);

        // // Load the VIEW
        return view('productFiles.edit', ['menu' => 'products', 'product' => $productDocument ]);
    }

    // Edit in database
    public function update(Request $request, ProductFile $file)
    {

        //dd('Product File Update: ', $request, $request->file('file'), $file);
        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Validar o formulário
            //$request->validated();
            // Send File
            if($request->hasFile('file') && $request->file('file')->isValid()){
	
                $requestFile = $request->file('file');
                $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
                
                // Upload File
                $fileName = date('YmdHi').'-'.$fileName;
                $requestFile->move(public_path('/files/product_file/'), $fileName);                


                // Checks if the old file still exists in the folder
                if($file->file != '' ){
                    $path = public_path('\files\product_file\\'.$file->file);
                    if(file_exists($path)){
                        // Physical deletion of the old Archive
                        unlink($path); 
                    }
                }
            }else{
                $fileName = $file->file;
            }

            // Editar as informações do registro no banco de dados
            $file->update([
                'name' => $request->name,
                'type' => $request->type,
                'file' => $fileName,
                'year' => date('Y'),
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Salvar log
            //Log::info('Producto editado.', [ 'product_id' => $product->id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            if($request->type == 'Technical'){
                $route = 'technical';
            }else{
                $route = 'document';
            }
            //dd('Request Type: ', $request->type);
            return redirect()->route('product.'.$route, ['product' => $file->product_id ])->with('success', 'Documento registrado exitosamente!');
 
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
    public function destroy(ProductFile $file)
    {
        //dd('Product Document Destroy: ', $file);
        $fileDestroy = $file->file;

        DB::beginTransaction();
        try {

            // Delete the record from the database
            $file->delete();
            
            // Checks if the old file still exists in the folder
            if($fileDestroy != '' ){
                $path = public_path('\files\product_file\\'.$fileDestroy);
                if(file_exists($path)){
                    // Physical deletion of the old Archive
                    unlink($path); 
                }
            }

            DB::commit();

            // Save log
            // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            if($file->type == 'Technical'){
                $route = 'technical';
            }else{
                $route = 'document';
            }
            //dd('Request Type: ', $request->type);
            return redirect()->route('product.'.$route, ['product' => $file->product_id ])->with('success', 'Documento eliminado exitosamente!');
            
        } catch (Exception $e) {

            // Save log
            // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operation does not complete successfully
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return back()->withInput()->with('error', '¡Documento no eliminado!');
        }    

    }
}
