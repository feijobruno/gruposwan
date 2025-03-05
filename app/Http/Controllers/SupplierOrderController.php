<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderItem;
use App\Models\Product;
use App\Models\Country;
use App\Models\StockMovement;
use App\Models\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierOrderController extends Controller
{
    // Dashboard
    public function index()
    {
        $data = DB::table('supplier_orders')
        ->select('supplier_orders.id','suppliers.supplier','supplier_orders.order', 'supplier_orders.buyer', 'supplier_orders.order_date', 'supplier_orders.delivery_date' ,'supplier_orders.last_update', 'supplier_orders.amount', 'supplier_orders.total_net_weight', 'supplier_orders.products','supplier_orders.currency' ,'supplier_orders.status')
        ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_orders.supplier_id')
        ->get();
                
        // Load the VIEW
        return view('supplierOrders.index', ['menu' => 'orders', 'data' => $data]);    
    }

    public function create(Supplier $supplier = null)
    {
        $countries = Country::where('status', 1)->get();

        if(!$supplier){
            $supplier = null;
            $suppliers = Supplier::get();
            $noSupplier = true;
            $products = DB::table('products')
            ->get();
        }else{
            $suppliers = null;
            $noSupplier = false;
            $products = DB::table('products')
            ->where('supplier_id', $supplier->id)
            ->get();  
        }

        $incoterm = DB::table('incoterm')
        ->select('id','incoterm')
        ->get();

        $customers = Customer::get();

        return view('supplierOrders.create', ['menu' => 'supplier-orders',  'countries' => $countries, 'supplier' => $supplier, 'suppliers' => $suppliers, 'customers' => $customers, 'products' => $products, 'noSupplier' => $noSupplier, 'incoterm'=>$incoterm ]);
    }

    public function store(Request $request)
    {

         //dd('Supplier Order Store: ',$request);

        $id_product = $request->id_product;
        $price = $request->price;
        $net_weight = $request->net_weight;
        $pallet = $request->pallet;
        $currency = $request->currency;
        
        $total_net_weight = 0; 
        $total_pallet = 0;
        $amount = 0;
        $currency_order = '';
       
        // $fileName = null;

        $products = '';
      

        // File
        // if($request->hasFile('file') && $request->file('file')->isValid()){
            
        //     $requestFile = $request->file;
        //     $extension = $requestFile->extension();
        //     // $fileName = md5($requestFile->getClientOriginalName());
        //     $fileName = $requestFile->getClientOriginalName();

        //     // Upload File
        //     $requestFile->move(public_path('img/orders'), $fileName);
        // }

        $supplier = Supplier::where('id', $request->supplier_id )->first();

        for ($i = 0; $i < count($id_product); $i++) {
            $total_net_weight += $net_weight[$i] * $pallet[$i];
            $amount += $price[$i] * $net_weight[$i];
            $total_pallet += (int)$pallet[$i];
            $currency_order = $currency[0];
            $product = Product::where('id', $id_product[$i] )->first();
            $products .= $product->product.' - '.number_format($net_weight[$i] * $pallet[$i], 0, ',', '.').' kg, ';
            // $products .= $id_product[$i].' - '.number_format($net_weight[$i] * $pallet[$i], 0, ',', '.').' kg, ';
        }
        
        // dd($products);

        $products = substr($products,0,-2);
        
        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        $supplierOrder = SupplierOrder::create([
            'order' => 0,
            'owner' => $request->owner,
            'supplier_id' => $request->supplier_id,            
            'order_date' => $request->order_date,
            'incoterm' => $request->incoterm,
            'forwarder' => $request->forwarder,
            'port' => $request->port,
            'etd' => $request->etd,
            'eta' => $request->eta,
            'last_update' => $request->last_update,           
            'delivery_date' => $request->delivery_date,    
            'due_date' => $request->due_date,
            'payment_term' => $request->payment_term,
            'observation' => $request->observation,
            'destination' => $request->destination,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'zip' => $request->zip,
            'street' => $request->street,
            'street2' => $request->street2,
            'products' => $products,
            'total_pallet' => $total_pallet,
            'total_net_weight' => $total_net_weight,
            'currency' => $currency_order,
            'amount' => $amount,
            'status' => $request->status,
        ]);

        /* ENVIANDO ARQUIVOS PARA SALVAR NO BANCO E ARMAZENAR NA PASTA */
        $requestFile = $request->file('file');
        
        foreach ($requestFile as $key => $value) {
            
            $requestFile = $value;
            $fileName = md5($requestFile->getClientOriginalName()).".".$requestFile->getClientOriginalExtension();
            
            // Upload File
            $fileName = date('YmdHi').'-'.$fileName;
            
            // Caso o arquivo seja movido com sucesso, realiza o insert na table FILE
            if($requestFile->move(public_path("/files/file_supplier_order/"), $fileName)){
                $supplierFile = SupplierOrder::where('id', $supplierOrder->id)->first();
                $supplierFile->files()->create([
                    'original_name' => $requestFile->getClientOriginalName(),
                    'file_name' => $fileName,
                    'file_path' => "/files/file_supplier_order/".$fileName,
                ]); 
            }
            
        }
        /* ENVIANDO ARQUIVOS PARA SALVAR NO BANCO E ARMAZENAR NA PASTA */
        

        for ($i = 0; $i < count($id_product); $i++) {
            SupplierOrderItem::create([
                'id_product' => $id_product[$i],
                'price' => $price[$i],
                'pallet' => $pallet[$i],
                'currency' => $currency[$i],
                'net_weight' => $net_weight[$i],
                'total_net_weight' => $net_weight[$i] * $pallet[$i],
                'order_id' => $supplierOrder->id,
            ]);

            StockMovement::create( [
                'product_id' => $id_product[$i],
                'movement_type' => 'in',
                'quantity' => $net_weight[$i] * $pallet[$i],
                'movement_date' => date('Y-m-d H:i:s'),
                'order_id' => $supplierOrder->id,
                'supplier_id' => $request->supplier_id         
             ]);

            DB::commit();
        }

        return redirect()->route('supplier.order', ['supplier' => $supplier])->with('success', '¡Pedido registrado exitosamente!');
    }

    public function show(SupplierOrder $order)
    {
        //Trazer as informações da customer_order
        $orderData = DB::table('supplier_orders')
        ->select('id','buyer','supplier_id','order', 'order_date', 'incoterm', 'forwarder', 'port', 'etd', 'eta', 'last_update', 'due_date','delivery_date', 'payment_term', 'observation','destination' ,'country','province','city','zip','street','street2', 'total_pallet', 'total_net_weight', 'currency', 'amount', 'status')
        ->where('id', $order->id)
        ->first();

        // Trazer os produtos vinculados a orden da query anterior
        $productData = DB::table('supplier_order_items')
        ->select('id','product', 'pallet','currency','price','net_weight', 'order_id')
        ->where('order_id', $orderData->id)
        ->get();

        // Retonar o cliente a que pertence a ordem.
        $supplierData = DB::table('suppliers')
        ->select('id','supplier')
        ->where('id', $orderData->supplier_id)
        ->first();

        //dd($orderData, $productData, $customerData);

        return view('supplierOrders.show', ['menu' => 'supplier-orders', 'supplier' => $supplierData, 'order' => $orderData, 'products' => $productData]);
        
    }

    public function edit(SupplierOrder $order)
    {

        $orderData = DB::table('supplier_orders')
        ->select('id','buyer','supplier_id','order', 'order_date', 'incoterm', 'forwarder', 'port', 'etd', 'eta', 'last_update', 'due_date','delivery_date', 'payment_term', 'observation','destination' ,'country','province','city','zip','street','street2', 'total_pallet', 'total_net_weight', 'currency', 'amount', 'status')
        ->where('id', $order->id)
        ->first();

        // Retonar o cliente a que pertence a ordem.
        $supplierData = DB::table('suppliers')
        ->select('id','supplier')
        ->where('id', $orderData->supplier_id)
        ->first();

        $countries = Country::where('status', 1)->get();
        
        $incoterm = DB::table('incoterm')
        ->select('id','incoterm')
        ->get();
        
        // Load the VIEW
        return view('supplierOrders.edit', ['menu' => 'supplier-orders', 'data' => $orderData, 'supplier' => $supplierData, 'countries' => $countries, 'incoterm' => $incoterm]);
    }

    public function generatePdf(SupplierOrder $order)
    {

        // Recuperar os registros do banco dados
        //$users = User::orderByDesc('id')->get();

      
        $supplierOrder = DB::table('supplier_orders')
        ->select('id','buyer','supplier_id','order', 'order_date', 'incoterm', 'forwarder', 'port', 'etd', 'eta', 'last_update', 'due_date','delivery_date', 'payment_term', 'observation','destination' ,'country','province','city','zip','street','street2', 'total_pallet', 'total_net_weight', 'currency', 'amount', 'status')
        ->where('id', $order->id)
        ->get();  
        
        $supplierOrderItems = DB::table('supplier_order_items')
        ->select('id','product','pallet', 'price', 'currency','net_weight', 'order_id')
        ->where('order_id', $order->id)
        ->get();  

        $supplier = DB::table('suppliers')
        ->select('id', 'supplier', 'country', 'province', 'zip', 'city', 'street', 'street2', 'email', 'phone', 'vat', 'bank_id', 'bank_id_acc_number', 'bank_swift', 'bank_iban')
        ->where('id', $order->supplier_id)
        ->get();  
       
        $order->buyer === 'Polymer Additives' ? 
        $pdf = PDF::loadView('supplierOrders.pdfPA', ['order' => $supplierOrder, 'products' => $supplierOrderItems, 'suppliers' => $supplier])->setPaper('a4', 'portrait') :
        $pdf = PDF::loadView('supplierOrders.pdfPS', ['order' => $supplierOrder, 'products' => $supplierOrderItems, 'suppliers' => $supplier])->setPaper('a4', 'portrait');

        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo

        $fileName = "{$order->order}.pdf";
        // Fazer o download do arquivo
        return $pdf->download($fileName);
    }
    public function batch(SupplierOrder $order){
       
        $data = DB::table('supplier_orders')
        ->select('supplier_orders.id','suppliers.supplier','supplier_orders.order', 'supplier_orders.buyer', 'supplier_orders.order_date', 'supplier_orders.delivery_date' ,'supplier_orders.last_update', 'supplier_orders.amount', 'supplier_orders.total_net_weight', 'supplier_orders.products','supplier_orders.currency' ,'supplier_orders.status')
        ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_orders.supplier_id')
        ->where('supplier_orders.id', $order->id)
        ->first();

        $dataItems = DB::table('supplier_order_items')
        ->select('supplier_order_items.id','supplier_order_items.product','supplier_order_items.pallet', 'supplier_order_items.price', 'supplier_order_items.currency', 'supplier_order_items.net_weight' ,'supplier_order_items.order_id')
        ->leftJoin('supplier_orders', 'supplier_orders.id', '=', 'supplier_order_items.order_id')
        ->where('supplier_order_items.order_id', $order->id)
        ->get();


        // $data = Supplier::where(column: 'id', $supplierOrder->supplier_id)->first();
        return view('supplierOrders.batch', ['menu' => 'supplier-orders', 'supplier_order' => $data, 'supplier_order_items' => $dataItems ]);
    }




    // public function destroy(SupplierOrder $supplierOrder)
    // {
    //     try {

    //         // Delete the record from the database
    //         $supplierOrder->delete();

    //         // Save log
    //         // Log::info('Aula apagada.', ['customer_id' => $customer->id, 'action_user_id' => Auth::id()]);

    //         // Redirecionar o usuário, enviar a mensagem de sucesso
    //         return redirect()->route('customer.index', ['customer' => $customer->customer_id])->with('success', '¡Cliente eliminada exitosamente!');
    //     } catch (Exception $e) {

    //         // Save log
    //         // Log::notice('Cliente não apagado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

    //         // Redirecionar o usuário, enviar a mensagem de sucesso
    //         return redirect()->route('customer.index', ['customer' => $customer->customer_id])->with('error', '¡Cliente no eliminado!');
    //     }
    // }



}
