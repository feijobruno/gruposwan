<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CustomerOrderItem extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'customer_order_items';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['product', 'price', 'qty', 'supplier_order', 'onwer'];

    public function customerOrder()
    {
        return $this->belongsTo(CustomerOrder::class);
    }

}
