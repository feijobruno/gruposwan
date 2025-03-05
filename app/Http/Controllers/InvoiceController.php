<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{

     public function index()
    {
             
        // Load the VIEW
        return view('invoices.index', [
            'menu' => 'invoice', 
            // 'data' => $data,
        ]);
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
