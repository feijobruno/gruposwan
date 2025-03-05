<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PresentationController extends Controller
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

        return view('presentation.create', ['menu' => 'comercial', 'entity' => $entity, 'entityData' => $entityData, 'entity_name' => $entity_name]);
    }

    public function store(Request $request, $entity, $id)
    {
        // Validate the form
        //$request->validate();       
        
        DB::beginTransaction();

        try {
            
            // Send File
            if($request->hasFile('file') && $request->file('file')->isValid()){
	
                $requestFile = $request->file('file');
                $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
                
                // Upload File
                $fileName = date('YmdHi').'-'.$fileName;
                $requestFile->move(public_path('/files/presentation_'.$entity.'/'), $fileName);
            }else{
                $fileName = null;
            }
            
            switch ($entity) {
                case 'customer':
                    // Register the values of all fields in the database in the table.
                    $customer = Customer::where('id', $id)->first();
                    $customer->presentations()->create([
                        'presentation_name'  => $request->presentation_name,
                        'presentation_date'  => $request->presentation_date,
                        'file'          => $fileName,
                        'year'          => explode('-',$request->presentation_date)[0],
                    ]);  
                    
                    $entityData = $customer;

                break;

                case 'supplier':
                    // Register the values of all fields in the database in the table.
                    $supplier = Supplier::where('id', $id)->first();
                    $supplier->presentations()->create([
                        'presentation_name'  => $request->presentation_name,
                        'presentation_date'  => $request->presentation_date,
                        'file'          => $fileName,
                        'year'          => explode('-',$request->presentation_date)[0],
                    ]);  
                    
                    $entityData = $supplier;
 
                break;

                case 'product':
                    // Register the values of all fields in the database in the table.
                    $product = Product::where('id', $id)->first();
                    $product->presentations()->create([
                        'presentation_name'  => $request->presentation_name,
                        'presentation_date'  => $request->presentation_date,
                        'file'          => $fileName,
                        'year'          => explode('-',$request->presentation_date)[0],
                    ]);  
                    
                    $entityData = $product;
 
                break;
                
                default:
                    return false;
                break;
            }

            DB::commit();

            // Redirect the user, send the success message
            //return redirect()->route($entity.'.presentation', [$entityData => $entityData ])->with('success', '¡Presentación registrada exitosamente!');
            return redirect()->route($entity.'.presentation', [$entity => $entityData ])->with('success', '¡Presentación registrada exitosamente!');   
           

        } catch (\Exception $e) {
            
            // Operation does not complete successfully
            DB::rollBack();
            //Redirect user, send error message
            return back()->withInput()->with('error', '¡Presentación no registrado!');
            
        } 

    }

    public function edit($entity, Presentation $presentation)
    {
        switch ($entity) {
            case 'customer':
                $entityData = Customer::where('id', $presentation->presentationable_id)->first();        
                $entity_name = $entityData->suplier;
            break;

            case 'supplier':
                $entityData = Supplier::where('id', $presentation->presentationable_id)->first();  
                $entity_name = $entityData->suplier;      
            break;

            case 'product':
                $entityData = Product::where('id', $presentation->presentationable_id)->first();  
                $entity_name = $entityData->Product;      
            break;
            
            default:
                $entity_name = '';
            break;
        }
        
        // Load the VIEW
        return view('presentation.edit', ['menu' => 'commercial', 'presentation' => $presentation, 'entity' => $entity,'entityData' => $entityData, 'entity_name' => $entity_name]);
    }

    public function update(Request $request, Presentation $presentation)
    {

        // Validate the form
        //$request->validated();

        $entity = strtolower(explode('\\',$presentation->presentationable_type)[2]);
        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Send File
            if($request->hasFile('file') && $request->file('file')->isValid()){
	
                $requestFile = $request->file('file');
                $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
                
                // Upload File
                $fileName = date('YmdHi').'-'.$fileName;
                $requestFile->move(public_path('/files/presentation_'.$entity.'/'), $fileName);                


                // Checks if the old file still exists in the folder
                if($presentation->file != '' ){
                    $caminhoArquivo = public_path('\files\presentation_'.$entity.'\\'.$presentation->file);
                    if(file_exists($caminhoArquivo)){
                        // Physical deletion of the old Archive
                        unlink($caminhoArquivo); 
                    }
                }
            }else{
                $fileName = $presentation->file;
            }
            
            // Edit record information in the database
            $presentation->update([
                'presentation_name' => $request->presentation_name,
                'presentation_date' => $request->presentation_date,
                'file' => $fileName,
                'year' => explode('-',$request->presentation_date)[0],
            ]);

            // La operación se completa con éxito
            DB::commit();

            // Save log
            // Log::info('Customer editado.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirect the user, send the success message
            switch ($entity) {
                case 'customer':
                    $entityData = Customer::where('id', $presentation->presentationable_id)->first();        
                break;

                case 'supplier':
                    $entityData = Supplier::where('id', $presentation->presentationable_id)->first();        
                break;

                case 'product':
                    $entityData = Product::where('id', $presentation->presentationable_id)->first();        
                break;
                
                default:
                    $entityData = '';
                break;
            }
            
            return redirect()->route($entity.'.presentation', [$entity => $entityData ])->with('success', '¡El presentación editó correctamente!');

        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Save log
            // Log::notice('Cliente sin editar.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Presentación sin editar!');
            
            
        }
    }

    public function destroy(Presentation $presentation)
    {
        $entity = strtolower(explode('\\',$presentation->presentationable_type)[2]);

        $fileDestroy = $presentation->file;

        DB::beginTransaction();
        try {

            // Delete the record from the database
            $presentation->delete();

            // Checks if the old file still exists in the folder
            if($fileDestroy != '' ){
                $caminhoArquivo = public_path('\files\presentation_'.$entity.'\\'.$fileDestroy);
                if(file_exists($caminhoArquivo)){
                    // Physical deletion of the old Archive
                    unlink($caminhoArquivo); 
                }
            }

            switch ($entity) {
                case 'customer':
                    // Search related customer 
                    $entityData = Customer::where('id', $presentation->presentationable_id)->first();                    
                break;
            
                case 'supplier':
                    // Search related customer
                    $entityData = Supplier::where('id', $presentation->presentationable_id)->first();
                break;

                case 'product':
                    // Search related customer
                    $entityData = Product::where('id', $presentation->presentationable_id)->first();
                break;
                
                default:
                    $entityData = '';
                break;
            }

            DB::commit();

            // Save log
            // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route($entity.'.presentation', [$entity => $entityData])->with('success', 'Presentacion eliminada exitosamente!');
        } catch (Exception $e) {

            // Save log
            // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return back()->withInput()->with('error', '¡Presentacion no eliminado!');
        }
    }
}