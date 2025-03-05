<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SupplierOrderItem extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'supplier_order_items';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['id_product', 'pallet', 'price', 'currency','net_weight', 'total_net_weight' ,'supplier_order', 'owner'];

    public function supplierOrder()
    {
        return $this->belongsTo(SupplierOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
