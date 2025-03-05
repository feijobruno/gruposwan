<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PaOrderItem extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'pa_order_items';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['id_product', 'pallet', 'price', 'currency','net_weight', 'total_net_weight' ,'pa_order_id'];

    public function paOrder()
    {
        return $this->belongsTo(PaOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
