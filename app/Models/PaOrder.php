<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PaOrder extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'pa_orders';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = [
        'order',
        'order_date',    
        'etd',
        'eta',
        'last_update',
        // 'due_date',
        'payment_term',
        'observation',
        'products',
        'total_pallet',
        'total_net_weight',
        'currency',
        'amount',
        'status',  
    ];

    public function paOrderItem()
    {
        return $this->hasMany(PaOrderItem::class);
    }

}
