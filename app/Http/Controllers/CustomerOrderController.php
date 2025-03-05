<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Http\Requests\ContactRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Country;

use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{

    public function index()
    {
 
       $data = DB::table('customer_orders')
       ->select('customers.id','customers.customer','customer_orders.order', 'customer_orders.order_date', 'customer_orders.delivery_date', 'customer_orders.total_amount', 'customer_orders.total_weight', 'customer_orders.products','customer_orders.file', 'customer_orders.status')
       ->leftJoin('customers', 'customers.id', '=', 'customer_orders.customer_id')
       ->get();
        
         // Load the VIEW
        return view('customerOrders.index', ['menu' => 'customer-orders', 'data' => $data ]);
    }

    public function create(Customer $customer)
    {
        $products = DB::table('supplier_order_items')
        ->select('supplier_order_items.id','products.product')
        ->leftJoin('products', 'products.id', '=', 'supplier_order_items.id_product')
        ->get();

        // Listar os status para pedido ( Dentro ou fora do armazem )
        $status_order = DB::table('status_order')
        ->select('id', 'status_desc', 'status_type')
        ->get();

        $countries = Country::where('status', 1)->get();

        return view('customerOrders.create', ['menu' => 'customer-orders',  'countries' => $countries, 'customer' => $customer, 'products' => $products, 'status_order' => $status_order]);
    }

    public function store(Request $request)
    {

        $product = $request->product;
        $price = $request->price;
        $qty = $request->qty;
        
        $total_amount = 0; 
        $total_weight = 0;
        $fileName = null;
        $products = '';

        // File
        if($request->hasFile('file') && $request->file('file')->isValid()){
            
            $requestFile = $request->file;
            // $extension = $requestFile->extension();
            $fileName = md5($requestFile->getClientOriginalName());
            // $fileName = $requestFile->getClientOriginalName();

            // Upload File
            $fileName = date('YmdHi').'-'.$fileName;
            $requestFile->move(public_path('img/customer_orders'), $fileName);
        }

        $customer = Customer::where('id', $request->customer_id )->first();

        for ($i = 0; $i < count($product); $i++) {
            $total_amount += $price[$i] * $qty[$i];
            $total_weight += $qty[$i];
            $products .= $product[$i].' - '.number_format($qty[$i], 0, ',', '.').' kg, ';
        }
        
        // dd($products);

        $products = substr($products,0,-2);
        
        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        $customerOrder = CustomerOrder::create([
            'customer_id' => $request->customer_id,
            'order' => $request->order,
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'payment_method' => $request->payment_method,
            'observation' => $request->observation,
            'file' => $fileName,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'zip' => $request->zip,
            'street' => $request->street,
            'street2' => $request->street2,
            'delivery_country' => $request->delivery_country,
            'delivery_province' => $request->delivery_province,
            'delivery_city' => $request->delivery_city,
            'delivery_zip' => $request->delivery_zip,
            'delivery_street' => $request->delivery_street,
            'delivery_street2' => $request->delivery_street2,
            'total_amount' => $total_amount,
            'total_weight' => $total_weight,
            'status' => $request->status,
            'products' => $products,
        ]);

        $request->validate([
            'product' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        for ($i = 0; $i < count($product); $i++) {
            CustomerOrderItem::create([
                'product' => $product[$i],
                'price' => $price[$i],
                'qty' => $qty[$i],
                'order_id' => $customerOrder->id,
            ]);

            DB::commit();
        }

        return redirect()->route('customer.order', ['customer' => $customer])->with('success', '¡Pedido registrado exitosamente!');
    }

    //Visualiza o Pedido
    public function show(Request $request)
    {
        $order = $request->order;

        //Trazer as informações da customer_order
        $orderData = DB::table('customer_orders')
        ->select('id','customer_id','order', 'order_date', 'delivery_date', 'payment_method','observation','file','country','province','city','zip','street','street2','delivery_country','delivery_province','delivery_city','delivery_zip','delivery_street','delivery_street2')
        ->where('order', $order)
        ->first();

        // Trazer os produtos vinculados a orden da query anterior
        $productData = DB::table('customer_order_items')
        ->select('id','product','price','qty')
        ->where('order_id', $orderData->id)
        ->get();

        // Retonar o cliente a que pertence a ordem.
        $customerData = DB::table('customers')
        ->select('id','customer')
        ->where('id', $orderData->customer_id)
        ->first();

        //dd($orderData, $productData, $customerData);

        return view('customerOrders.show', ['menu' => 'customer-orders', 'customer' => $customerData, 'order' => $orderData, 'products' => $productData]);
        
    }

    // Abre o formulario com o registro a ser editado
    public function edit(Request $request)
    {
        $order = $request->order;

        //Trazer as informações da customer_order
        $orderData = DB::table('customer_orders')
        ->select('id','customer_id','order', 'order_date', 'delivery_date', 'payment_method','observation','file','country','province','city','zip','street','street2','delivery_country','delivery_province','delivery_city','delivery_zip','delivery_street','delivery_street2')
        ->where('order', $order)
        ->first();

        // Trazer os produtos vinculados a orden da query anterior
        $productsData = DB::table('customer_order_items')
        ->select('id','product','price','qty')
        ->where('order_id', $orderData->id)
        ->get();

        // Retonar o cliente a que pertence a ordem.
        $customerData = DB::table('customers')
        ->select('id','customer')
        ->where('id', $orderData->customer_id)
        ->first();
        
        $addressMain = array(
            "country" => $orderData->country,
            "province" => $orderData->province,
            "city" => $orderData->city,
            "zip" => $orderData->zip,
            "street" => $orderData->street,
            "street2" => $orderData->street2, 
        );

        $addressDelivery = array(
            "delivery_country" => $orderData->delivery_country,
            "delivery_province" => $orderData->delivery_province,
            "delivery_city" => $orderData->delivery_city,
            "delivery_zip" => $orderData->zip,
            "delivery_street" => $orderData->delivery_street,
            "delivery_street2" => $orderData->delivery_street2,                
        );

        $products = Product::get();

        $countries = Country::where('status', 1)->get();
        //dd('Customer Controller Linha 214: ', $addressMain, $addressDelivery);

        $payment_method = [
            'Transf. 60 dias fecha factura' => 'Transf. 60 dias fecha factura',
            'Transf. 45 dias fecha factura' =>'Transf. 45 dias fecha factura',
            'Transf. 30 dias fecha factura' => 'Transf. 30 dias fecha factura'
        ];
        
        return view('customerOrders.edit', ['menu' => 'customer-orders', 'customer' => $customerData, 'order' => $orderData, 'products' => $products,'productsData' => $productsData, 'countries' => $countries, 'payment_method' => $payment_method, 'addressMain' => $addressMain, 'addressDelivery' => $addressDelivery]);
        //'products' => $products, 
        
    }


    public function update( Request $request )
    {
        //dd('Update Linha 228: ', $request);

        // Validate the form
        $request->validate([
            'product' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);


        $product = $request->product;
        $price = $request->price;
        $qty = $request->qty;
        
        $total_amount = 0; 
        $total_weight = 0;
        $fileName = null;
        $products = '';

        for ($i = 0; $i < count($product); $i++) {
            $total_amount += $price[$i] * $qty[$i];
            $total_weight += $qty[$i];
            $products .= $product[$i].' - '.number_format($qty[$i], 0, ',', '.').' kg, ';
        }
        
        // dd($products);

        $products = substr($products,0,-2);

        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Edit record information in the database
            $edit = DB::table('customer_orders')
            ->where('id', $request->id)
            ->update([
                'order_date' => $request->order_date,
                'delivery_date' => $request->delivery_date,
                'payment_method' => $request->payment_method,
                'observation' => $request->observation,
                'products' => $products,
                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
                'zip' => $request->zip,
                'street' => $request->street,
                'street2' => $request->street2,
                'delivery_country' => $request->delivery_country,
                'delivery_province' => $request->delivery_province,
                'delivery_city' => $request->delivery_city,
                'delivery_zip' => $request->delivery_zip,
                'delivery_street' => $request->delivery_street,
                'delivery_street2' => $request->delivery_street2,
            ]);

            // Após atualizar a customer_orders, atualizar a customer_orders_products
            // Fluxo para atualização, deletar os registros vinculados ao número da ordem e cadastrar os registros novamente.
            $deleted = DB::table('customer_order_items')->where('order_id', '=', $request->id)->delete();

            // Após exclusão dos produtos, são inseridos os enviados
            for ($i = 0; $i < count($product); $i++) {
                $ProductsInsert = DB::table('customer_order_items')->insert([
                    'order_id' => $request->id,
                    'product' => $product[$i],
                    'price' => $price[$i],
                    'qty' => $qty[$i]
                ]);
            } 

            // La operación se completa con éxito
            DB::commit();

            // Save log
            // Log::info('Customer editado.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // Redirect the customer orders, send the success message
            $data = DB::table('customer_orders')
            ->select('customers.id','customers.customer','customer_orders.order', 'customer_orders.order_date', 'customer_orders.delivery_date', 'customer_orders.total_amount', 'customer_orders.total_weight', 'customer_orders.products','customer_orders.file', 'customer_orders.status')
            ->leftJoin('customers', 'customers.id', '=', 'customer_orders.customer_id')
            ->get();

            //return redirect()->route('ordersCustomer.edit', ['menu' => 'customer-orders', 'data' => $data])->with('success', '¡Pedido del cliente actualizado correctamente!');
            return redirect()->route('customer.order', $request->customer_id)->with('success', '¡Pedido del cliente actualizado correctamente!');		
            
            
            // Load the VIEW
            
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Save log
            // Log::notice('Cliente sin editar.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', '¡Pedido del Cliente sin actualizar!');
            
        }
    }

    
    public function destroy(Request $request){

        // Buscando as informações da Ordem
        $customer_id = DB::table('customer_orders')
        ->select('id', 'customer_id','order')
        ->where('order', $request->order)
        ->first();

        // Marks the starting point of a transaction
        DB::beginTransaction();

        try {

            // Deletando primeiro os produtos vinculados a Ordem
            $deletedProduct = DB::table('customer_order_items')->where('order_id', $customer_id->id)->delete();

            // Após deletar os produtos, deletando a Ordem
            $deleteOrder = DB::table('customer_orders')->where('id', $customer_id->id)->delete();

            //dd('Delete Order Linha 189: ', $deleteOrder);
            // Save log
            // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

            // La operación se completa con éxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('customer.order', $customer_id->customer_id)->with('success', '¡Pedido del Cliente eliminada exitosamente!');
        } catch (Exception $e) {

            // Save log
            // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('customer.order', $customer_id->customer_id)->with('error', '¡Pedido del Cliente sin eliminada!');
        }

    }
}
