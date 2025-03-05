<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Metting;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MettingController extends Controller
{
    //
    public function create($entity, $id)
    {
        
        switch ($entity) {
            case 'customer':
                $entityData = Customer::where('id', $id)->first();  
                $entity_name = $entityData->customer;
            break;

            case 'supplier':
                $entityData = Supplier::where('id', $id)->first();
                $entity_name = $entityData->supplier;
            break;

            case 'product':
                $entityData = Product::where('id', $id)->first();
                $entity_name = $entityData->product;
            break;
            
            default:
                $entityData = '';
            break;
        }
        
        return view('metting.create', ['menu' => 'commercial', 'entity' => $entity, 'entityData' => $entityData, 'entity_name' => $entity_name]);
    }

    public function store(Request $request, $entity, $id)
    {
        // Validate the form
        //$request->validate();
        
        DB::beginTransaction();
        //dd('Store Metting: ', $entity, $id, $request, $request->file('file'));
        try {
            
            // Send File
            if($request->hasFile('file') && $request->file('file')->isValid()){
	
                $requestFile = $request->file('file');
                $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
                
                // Upload File
                $fileName = date('YmdHi').'-'.$fileName;
                $requestFile->move(public_path("/files/metting_".$entity."/"), $fileName);
            }else{
                $fileName = null;
            }
                
            
            
            // Register the values of all fields in the database in the table.
            switch ($entity) {
                case 'customer':
                    $customer = Customer::where('id', $id)->first();
                    $customer->mettings()->create([
                        'metting_name'      => $request->metting_name,
                        'metting_date'      => $request->metting_date,
                        'file'              => $fileName,
                        'year'              => explode('-',$request->metting_date)[0],
                    ]);  
                   
                    $entityData = $customer; 
                break;

                case 'supplier':
                    $supplier = Supplier::where('id', $id)->first();
                    $supplier->mettings()->create([
                        'metting_name'      => $request->metting_name,
                        'metting_date'      => $request->metting_date,
                        'file'              => $fileName,
                        'year'              => explode('-',$request->metting_date)[0],
                    ]);  
                   
                    $entityData = $supplier;
                break;

                case 'product':
                    $product = product::where('id', $id)->first();
                    $product->mettings()->create([
                        'metting_name'      => $request->metting_name,
                        'metting_date'      => $request->metting_date,
                        'file'              => $fileName,
                        'year'              => explode('-',$request->metting_date)[0],
                    ]);  
                   
                    $entityData = $product;
                break;
                
                default:
                    return false;
                break;
            }
            
            DB::commit();
            
            // Redirect the user, send the success message
            //return redirect()->route('customer.metting', ['entityData' => $entityData ])->with('success', '¡Reunión registrada exitosamente!');
            return redirect()->route($entity.'.metting', [$entity => $entityData ])->with('success', '¡Reunión registrada exitosamente!');   
            
        } catch (Exception $e) {
            
            // Operation does not complete successfully
            DB::rollBack();
            //Redirect user, send error message
            return back()->withInput()->with('error', '¡Reunión no registrado!');
            
            
        }
    }

    public function edit($entity, Metting $metting)
    {
        //dd('Edit: ', $entity, $metting);
        switch ($entity) {
            case 'customer':
                $entityData = Customer::where('id', $metting->mettingable_id)->first();  
                $entity_name = $entityData->customer;      
            break;

            case 'supplier':
                $entityData = Supplier::where('id', $metting->mettingable_id)->first();  
                $entity_name = $entityData->suplier;      
            break;

            case 'product':
                $entityData = Product::where('id', $metting->mettingable_id)->first();  
                $entity_name = $entityData->product;      
            break;
            
            default:
                $entityData = '';
            break;
        }

        // Load the VIEW
        return view('metting.edit', ['menu' => 'commercial', 'metting' => $metting, 'entity' => $entity, 'entityData' => $entityData, 'entity_name' => $entity_name]);

        
    }

    public function update(Request $request, Metting $metting)
    {
        // Validate the form
        //$request->validated();

        $entity = strtolower(explode('\\',$metting->mettingable_type)[2]);
        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Send File
            if($request->hasFile('file') && $request->file('file')->isValid()){
	
                $requestFile = $request->file('file');
                $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
                
                // Upload File
                $fileName = date('YmdHi').'-'.$fileName;
                $requestFile->move(public_path('/files/metting_'.$entity.'/'), $fileName);                


                // Checks if the old file still exists in the folder
                if($metting->file != '' ){
                    $caminhoArquivo = public_path('\files\metting_'.$entity.'\\'.$metting->file);
                    if(file_exists($caminhoArquivo)){
                        // Physical deletion of the old Archive
                        unlink($caminhoArquivo); 
                    }
                }
            }else{
                $fileName = $metting->file;
            }
            
            // Edit record information in the database
            $metting->update([
                'metting_name' => $request->metting_name,
                'metting_date' => $request->metting_date,
                'file' => $fileName,
                'year' => explode('-',$request->metting_date)[0],
            ]);

            // La operación se completa con éxito
            DB::commit();

            // Save log
            // Log::info('Customer editado.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirect the user, send the success message
            switch ($entity) {
                case 'customer':
                    $entityData = Customer::where('id', $metting->mettingable_id)->first();
                break;

                case 'supplier':
                    $entityData = Supplier::where('id', $metting->mettingable_id)->first();
                break;

                case 'product':
                    $entityData = Product::where('id', $metting->mettingable_id)->first();
                break;
                
                default:
                    $entityData = '';
                break;
            }
            
            return redirect()->route($entity.'.metting', [$entity => $entityData ])->with('success', '¡Reunión editó exitosamente!');

        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Save log
            // Log::notice('Cliente sin editar.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Reunión sin editar!');
            
        }
    }

    public function destroy(Metting $metting)
    {
        $entity = strtolower(explode('\\',$metting->mettingable_type)[2]);

        $fileDestroy = $metting->file;

        DB::beginTransaction();
        try {

            // Delete the record from the database
            $metting->delete();
            
            // Checks if the old file still exists in the folder
            if($fileDestroy != '' ){
                $caminhoArquivo = public_path('\files\metting_'.$entity.'\\'.$fileDestroy);
                if(file_exists($caminhoArquivo)){
                    // Physical deletion of the old Archive
                    unlink($caminhoArquivo); 
                }
            }

            switch ($entity) {
                case 'customer':
                    // Search related customer
                    $entityData = Customer::where('id', $metting->mettingable_id)->first();
                break;

                case 'supplier':
                    // Search related customer
                    $entityData = Supplier::where('id', $metting->mettingable_id)->first();
                break;

                case 'product':
                    // Search related customer
                    $entityData = Product::where('id', $metting->mettingable_id)->first();
                break;
                
                default:
                    $entityData = '';
                break;
            }

            DB::commit();

            // Save log
            // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route($entity.'.metting', [$entity => $entityData])->with('success', 'Reunión eliminada exitosamente!');
        } catch (Exception $e) {

            // Save log
            // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operation does not complete successfully
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            //return redirect()->route('customer.metting', [$entity => $entityData])->with('error', '¡Reunión no eliminado!');
            return back()->withInput()->with('error', '¡Reunión no eliminado!');
        }
    }

}