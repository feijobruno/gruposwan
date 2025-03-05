<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Contact;
use Illuminate\Http\Client\Request;

class ContactController extends Controller
{

    public function customer(Customer $customer)
    {
    
        return view('contacts.customer', ['menu' => 'commercial', 'customer' => $customer]);
    }

    public function supplier(Supplier $supplier)
    {
    
        return view('contacts.supplier', ['menu' => 'commercial', 'supplier' => $supplier]);
    }

    public function contactCustomer(ContactRequest $request , Customer $customer)
    {
     
    // Validate the form
    $request->validated();
    
    // Marks the starting point of a transaction
    DB::beginTransaction();

      try {

          // Register the values ​​of all fields in the database in the table
          $customer->contacts()->create([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'position' => $request->position,
              'post' => $request->post,
          ]);

          // Operation completes successfully
          DB::commit();

          // Save log
          // Log::info('Cliente registrado.', [ 'product_id' => $product->id]);

          // Redirect the user, send the success message
          return redirect()->route('customer.contact', ['customer' => $customer ])->with('success', '¡Contacto registrado exitosamente!');

      } catch (Exception $e) {

          // Operation does not complete successfully
          DB::rollBack();

          // Save log
        //   Log::notice('Producto no registrado.', [ 'error' => $e->getMessage()]);

          //Redirect user, send error message
   
          return back()->withInput()->with('error', '¡Contacto no registrado!');
      }
    }

    public function contactSupplier(ContactRequest $request , Supplier $supplier)
    {
     
    // Validate the form
    $request->validated();
    
    // Marks the starting point of a transaction
    DB::beginTransaction();

      try {

          // Register the values ​​of all fields in the database in the table
          $supplier->contacts()->create([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'position' => $request->position,
              'post' => $request->post,
          ]);

          // Operation completes successfully
          DB::commit();

          // Save log
          // Log::info('Cliente registrado.', [ 'product_id' => $product->id]);

          // Redirect the user, send the success message
          return redirect()->route('supplier.show', ['supplier' => $supplier])->with('success', '¡Contacto registrado exitosamente!');

      } catch (Exception $e) {

          // Operation does not complete successfully
          DB::rollBack();

          // Save log
        //   Log::notice('Producto no registrado.', [ 'error' => $e->getMessage()]);

          //Redirect user, send error message
   
          return back()->withInput()->with('error', '¡Contacto no registrado!');
      }
    }


    public function edit(Contact $contact)
    {
        if($contact->contactable_type == 'App\Models\Customer')
        {
            $onwer = DB::table('customers')
            ->leftJoin('contacts', 'contactable_id', '=', 'customers.id')
            ->select('customers.id','customers.customer AS name')
            ->where('contactable_id', $contact->contactable_id)
            ->first();
            $onwer->type = 'customer';

        }else
        {
            $onwer = DB::table('suppliers')
            ->leftJoin('contacts', 'contactable_id', '=', 'suppliers.id')
            ->select('suppliers.id','suppliers.supplier AS name')
            ->where('contactable_id', $contact->contactable_id)
            ->first();
            $onwer->type = 'supplier';
        }
       
        // Load the VIEW
        return view('contacts.edit', [
            'menu' => 'commercial', 
            'data' => $contact,
            'onwer' => $onwer 
        ]);
    }

    public function update(ContactRequest $request, Contact $contact)
    {

        // Validate the form
        $request->validated();

        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Edit record information in the database
            $contact->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'position' => $request->position,
                'post' => $request->post,
            ]);

            // La operación se completa con éxito
            DB::commit();
        
            return redirect()->route("{$request->onwer}.show", [ $request->onwer => $contact->contactable_id])->with('success', '¡Contacto editado exitosamente!');
            
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Save log
            // Log::notice('Proveedor sin editar.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Contacto sin editar!');
        }
    }

    public function destroy(Contact $contact)
    {
        try {

            $contactable = Contact::find($contact->id);
            // Delete the record from the database
            
            $contact->delete();

            // Save log
            // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            
            if($contactable->contactable_type === 'App\Models\Customer'){
                return redirect()->route('customer.contact', ['customer' => $contactable->contactable_id  ])->with('success', '¡Contacto eliminado exitosamente!');
            }else{
                return redirect()->route('supplier.show',['supplier' => $contactable->contactable_id ])->with('success', '¡Contacto eliminado exitosamente!');
            }
        } catch (Exception $e) {

            // Save log
            // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso

            return redirect()->route('customer.index', ['contact' => $contact->contact_id])->with('error', '¡Contacto no eliminado!');
        }
    }
}
