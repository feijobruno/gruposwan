<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderItem;
use App\Models\Product;
use App\Models\Country;
use App\Models\StockMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaOrderController extends Controller
{
    // Dashboard
    public function index()
    {
        $data = DB::table('pa_orders')->get();
                
        // Load the VIEW
        return view('paOrders.index', ['menu' => 'orders', 'data' => $data]);    
    }

    public function create()
    {

        $productData = DB::table('supplier_order_items')
        ->select('supplier_order_items.id','supplier_order_items.id_product', 'products.product', 'supplier_order_items.pallet', 'supplier_order_items.price', 'supplier_order_items.currency', 'supplier_order_items.net_weight' ,'supplier_order_items.order_id')
        ->leftJoin('products', 'products.id', '=', 'supplier_order_items.id_product')
        // ->where('supplier_order_items.order_id', $order->id)
        ->get();

        $incoterm = DB::table('incoterm')
        ->select('id','incoterm')
        ->get();

        return view('paOrders.create', ['menu' => 'pa-orders',  'products' => $productData, 'incoterm' => $incoterm ]);
    }

    public function store(Request $request)
    {

        dd($request);
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

        //dd($orderData, $productData, $customerData);

        return view('supplierOrders.show', ['menu' => 'supplier-orders', 'products' => $productData]);
        
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

        // Load the VIEW
        return view('supplierOrders.edit', ['menu' => 'supplier-orders', 'data' => $orderData, 'supplier' => $supplierData, 'countries' => $countries]);
 
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
