<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PolymerAdditivesController extends Controller
{

     public function index()
    {
           
        
        $data = DB::table('supplier_orders')
        ->select('suppliers.id','suppliers.supplier','supplier_orders.order', 'supplier_orders.buyer', 'supplier_orders.order_date', 'supplier_orders.delivery_date' ,'supplier_orders.last_update', 'supplier_orders.amount', 'supplier_orders.total_net_weight', 'supplier_orders.products','supplier_orders.currency' ,'supplier_orders.status')
        ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_orders.supplier_id')
        ->where('buyer', 'Polymer Additives')
        ->get();
                

        // Load the VIEW
        return view('polymerAdditives.index', ['menu' => 'additives', 'data' => $data ]);
    }

  
    public function show()
    {
      
 
    }

    
    public function create()
    {
     
    }

    
    public function store()
    {
     
    }

    public function edit()
    {
                
    }


    public function update()
    {

    }


    public function destroy()
    {

    }
}
