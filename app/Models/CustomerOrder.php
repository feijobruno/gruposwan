<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CustomerOrder extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'customer_orders';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = [
        'customer_id',
        'order',
        'order_date',
        'delivery_date',
        'payment_method',
        'observation',
        'file',
        'country',
        'province',
        'city',
        'zip',
        'street',
        'street2',
        'delivery_country',
        'delivery_province',
        'delivery_city',
        'delivery_zip',
        'delivery_street',
        'delivery_street2',
        'total_amount',
        'total_weight',
        'status',
        'products'
    ];

    public function customerOrderItem()
    {
        return $this->hasMany(CustomerOrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}
