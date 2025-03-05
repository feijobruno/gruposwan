<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Country;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{

    public function index()
    {
        $data = DB::table('customers')->get();

        //Load the VIEW
        return view('customers.index', [
            'menu' => 'commercial',
            'data' => $data,
        ]);
    }

     public function create()
    {
        $countries = Country::where( 'status', 1)->get();

        return view('customers.create', ['menu' => 'commercial',  'countries' => $countries]);
    }


    public function store(CustomerRequest $request)
    {
        // Validate the form
        $request->validated();

        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Register the values ​​of all fields in the database in the table
            $customer = Customer::create([
                'customer' => $request->customer,
                'vat' => $request->vat,
                'email' => $request->email,
                'phone' => $request->phone,
                'bank_id' => $request->bank_id,
                'bank_id_acc_number' => $request->bank_id_acc_number,
                'bank_swift' => $request->bank_swift,
                'bank_iban' => $request->bank_iban,
                'country' => $request->country,
                'province' => $request->province,
                'zip' => $request->zip,
                'city' => $request->city,
                'street' => $request->street,
                'street2' => $request->street2,
                'delivery_country' => $request->delivery_country,
                'delivery_province' => $request->delivery_province,
                'delivery_zip' => $request->delivery_zip,
                'delivery_city' => $request->delivery_city,
                'delivery_street' => $request->delivery_street,
                'delivery_street2' => $request->delivery_street2,

            ]);
      
            //Operation completes successfully
            DB::commit();

       
            //Redirect the user, send the success message
            return redirect()->route('customer.index', ['customer' => $customer->id])->with('success', '¡Cliente registrado exitosamente!');

        } catch (Exception $e) {

            // Operation does not complete successfully
            DB::rollBack();

            // Save log
            //   Log::notice('Producto no registrado.', [ 'error' => $e->getMessage()]);

            // Redirect user, send error message
            return back()->withInput()->with('error', '¡Cliente no registrado!');
        }
    }

    public function edit(Customer $customer)
    {
        $data = Customer::where('id', $customer->id)->first();
        // $data = DB::table('customers')
        // ->where('customers.id', $customer->id)
        // ->get();

        // dd($data);

        $countries = Country::where('status', 1)->get();
        // Load the VIEW
        return view('customers.edit', ['menu' => 'commercial', 'data' => $data, 'countries' => $countries]);
    }


    public function update(CustomerRequest $request, Customer $customer)
    {

        // Validate the form
        $request->validated();

        // Marks the starting point of a transaction
        DB::beginTransaction();
        // dd($request);
        try {

            // Edit record information in the database
            $customer->update([
                'customer' => $request->customer,
                'vat' => $request->vat,
                'email' => $request->email,
                'phone' => $request->phone,
                
                'bank_id' => $request->bank_id,
                'bank_id_acc_number' => $request->bank_id_acc_number,
                'bank_swift' => $request->bank_swift,
                'bank_iban' => $request->bank_iban,
                
                'country' => $request->country,
                'province' => $request->province,
                'zip' => $request->zip,
                'city' => $request->city,
                'street' => $request->street,
                'street2' => $request->street2,
                
                'delivery_country' => $request->delivery_country,
                'delivery_province' => $request->delivery_province,
                'delivery_zip' => $request->delivery_zip,
                'delivery_city' => $request->delivery_city,
                'delivery_street' => $request->delivery_street,
                'delivery_street2' => $request->delivery_street2
            ]);

            // La operación se completa con éxito
            DB::commit();

            // Save log
            // Log::info('Customer editado.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirect the user, send the success message
            return redirect()->route('customer.index', ['customer' => $customer->customer_id])->with('success', '¡El cliente editó correctamente!');
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // dd(vars: $e->getMessage());
            // Save log
            //Log::notice('Cliente sin editar.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Cliente sin editar!');
        }
    }


    public function destroy(Customer $customer)
    {
        try {

            // Delete the record from the database
            $customer->delete();

            // Save log
            // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('customer.index', ['customer' => $customer->customer_id])->with('success', '¡Cliente eliminada exitosamente!');
        } catch (Exception $e) {

            // Save log
            // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('customer.index', ['customer' => $customer->customer_id])->with('error', '¡Cliente no eliminado!');
        }
    }

    public function order(Customer $customer)
    {
 
        // $data = DB::table('customer_orders')
        // ->select('id', 'order', 'order_date', 'delivery_date', 'total_amount', 'quantity_products', 'file')
        // // ->leftJoin('customers', 'customers.id', '=', 'customer_orders.customer_id')
        // ->where('customer_id', $customer->id)
        // ->get(); 

        $data = DB::table('customer_orders')
       ->select('customers.id','customers.customer','customer_orders.order', 'customer_orders.order_date', 'customer_orders.delivery_date', 'customer_orders.total_amount', 'customer_orders.total_weight', 'customer_orders.products','customer_orders.file', 'customer_orders.status')
       ->leftJoin('customers', 'customers.id', '=', 'customer_orders.customer_id')
       ->where('customer_id', $customer->id)
       ->get();
                
         // Load the VIEW
        return view('customers.order', ['menu' => 'commercial', 'data' => $data, 'customer' => $customer ]);
    }

    public function contact(Customer $customer)
    {
        // Save log
        // Log::info('Ver cliente.', [ 'customer_id' => $customer->id]);

        $contacts = $customer->contacts;

        // Load the VIEW
        return view('customers.contact', ['menu' => 'commercial', 'contacts' => $contacts ,'customer' => $customer]);
    }

    public function metting(Customer $customer)
    {
        // Save log
        // Log::info('Ver cliente.', [ 'customer_id' => $customer->id]);

        $mettings = $customer->mettings;

        // Load the VIEW
        return view('customers.metting', ['menu' => 'commercial', 'mettings' => $mettings, 'customer' => $customer ]);
    }

    public function presentation(Customer $customer)
    {
        // Save log
        // Log::info('Ver cliente.', [ 'customer_id' => $customer->id]);
        $presentations = $customer->presentations;

         // Load the VIEW
         return view('customers.presentation', ['menu' => 'commercial', 'presentations' => $presentations, 'customer' => $customer ]);
    }

    public function findCustomer(Request $request){
        
        $id = $request->id;
        $customer = Customer::find($id);
        //return response()->json($customer);
        
        return $customer;
        
    }
}
