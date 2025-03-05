<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Country;


class SupplierController extends Controller
{

    public function index()
    {
        $data = Supplier::get();
       
        // Carregar a VIEW
        return view('suppliers.index', [
            'menu' => 'commercial', 
            'data' => $data,
        ]);
    }
   
    public function create()
    {
        $countries = Country::where('status', 1)->get();

        return view('suppliers.create', ['menu' => 'commercial',  'countries' => $countries]);
    }

    
    public function store(SupplierRequest $request)
    {
      // Validate the form
      $request->validated();

      // Marks the starting point of a transaction
      DB::beginTransaction();

      try {

          // Register the values ​​of all fields in the database in the table
          $supplier = Supplier::create([
              'supplier' => $request->supplier,
              'country' => $request->country,
              'province' => $request->province,
              'zip' => $request->zip,
              'city' => $request->city,
              'street' => $request->street,
              'street2' => $request->street2,
          ]);

          // Operation completes successfully
          DB::commit();

          // Save log
          // Log::info('Proveedor registrado.', [ 'product_id' => $product->id]);

          // Redirect the user, send the success message
          return redirect()->route('supplier.show', ['supplier' => $supplier->id])->with('success', '¡Proveedor registrado exitosamente!');
      } catch (Exception $e) {

          // Operation does not complete successfully
          DB::rollBack();

          // Save log
        //   Log::notice('Producto no registrado.', [ 'error' => $e->getMessage()]);

          // Redirect user, send error message
          return back()->withInput()->with('error', '¡Proveedor no registrado!');
      }
    }

    public function edit(Supplier $supplier)
    {
        $countries = Country::where( 'status', 1)->get();
        // Load the VIEW
        return view('suppliers.edit', ['menu' => 'commercial', 'data' => $supplier, 'countries' => $countries]);
        
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {

        // dd($request);
        // Validate the form
        $request->validated();

        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Edit record information in the database
            $supplier->update([
                'supplier' => $request->supplier,
                'country' => $request->country,
                'province' => $request->province,
                'zip' => $request->zip,
                'city' => $request->city,
                'street' => $request->street,
                'street2' => $request->street2,
            ]);

            // La operación se completa con éxito
            DB::commit();

            // Save log
            // Log::info('Supplier editado.', ['supplier_id' => $supplier->id, 'action_user_id' => Auth::id()]);

            // Redirect the user, send the success message
            return redirect()->route('supplier.index', ['supplier' => $supplier->supplier_id])->with('success', '¡El proveedoer editó correctamente!');
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Save log
            // Log::notice('Proveedor sin editar.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Proveedor sin editar!');
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {

            // Delete the record from the database
            $supplier->delete();

            // Save log
            // Log::info('Aula apagada.', ['supplier_id' => $supplier->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('supplier.index', ['supplier' => $supplier->supplier_id])->with('success', '¡Proveedor eliminada exitosamente!');
        } catch (Exception $e) {

            // Save log
            // Log::notice('Proveedor não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('supplier.index', ['supplier' => $supplier->supplier_id])->with('error', '¡Proveedor no eliminado!');
        }
    }

    public function order(Supplier $supplier)
    {
        $data = DB::table('supplier_orders')
        ->select('supplier_orders.id', 'suppliers.supplier','supplier_orders.order', 'supplier_orders.buyer', 'supplier_orders.order_date', 'supplier_orders.delivery_date' ,'supplier_orders.last_update', 'supplier_orders.amount', 'supplier_orders.total_net_weight', 'supplier_orders.products','supplier_orders.currency' ,'supplier_orders.status')
        ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_orders.supplier_id')
        ->where('supplier_id', $supplier->id)
        ->get();
                
        // Load the VIEW
        return view('suppliers.order', ['menu' => 'commercial', 'data' => $data, 'supplier' => $supplier ]);    

    }

    public function contact(Supplier $supplier)
    {
        // Save log
        // Log::info('Ver cliente.', [ 'customer_id' => $customer->id]);

        $contacts = $supplier->contacts;

        // Load the VIEW
        return view('suppliers.contact', ['menu' => 'commercial', 'contacts' => $contacts ,'supplier' => $supplier]);
    }

    public function metting(Supplier $supplier)
    {
        $mettings = $supplier->mettings;

        return view('suppliers.metting', ['menu' => 'commercial', 'mettings' => $mettings, 'supplier' => $supplier ]);
    }

    public function presentation(Supplier $supplier)
    {
        // Save log
        // Log::info('Ver cliente.', [ 'customer_id' => $customer->id]);
        $presentations = $supplier->presentations;
         // Load the VIEW
        return view('suppliers.presentation', ['menu' => 'commercial', 'presentations' => $presentations, 'supplier' => $supplier ]);
    }

}
