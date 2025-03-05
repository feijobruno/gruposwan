<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\StockMovement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockMovementController extends Controller
{

    // Detalhes do perfil
    public function index()
    {
        // Recuperar do banco de dados as informações do usuário logado
        $data = StockMovement::orderBy('movement_date', 'DESC')->get();

        $data = DB::table('stock_movements')
        ->leftJoin('products', 'stock_movements.product_id', '=', 'products.id')
        ->leftJoin('suppliers', 'stock_movements.supplier_id', '=', 'suppliers.id')
        ->leftJoin('supplier_orders', 'stock_movements.order_id', '=', 'supplier_orders.id')
        ->select('stock_movements.id','products.product', 'stock_movements.movement_type','stock_movements.quantity','stock_movements.movement_date','supplier_orders.order', 'suppliers.supplier')
        ->get();

        // Carregar a VIEW
        return view('stockMovements.index', ['data' => $data]);
    }

    // Carregar o formulário editar perfil
    public function update(Request $request)
    {
        // Recuperar do banco de dados as informações do usuário logado
        $country = Country::where('country', $request->country)->first();
        DB::beginTransaction();
        

        if($country->status == 1){
            DB::table('countries')
            ->where('country', $request->country )
            ->update(['status' => 0]);
        }else{
            DB::table('countries')
            ->where('country', $request->country )
            ->update(['status' => 1]);
        }

        DB::commit();
    
        $data = Country::orderBy('status', 'DESC')->orderBy('country', 'ASC')->get();
        // Carregar a VIEW
        return redirect()->route('helperTables.index', ['data' => $data])->with('success', 'País editado exitosamente.'); 
    }

}
