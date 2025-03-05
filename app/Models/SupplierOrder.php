<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SupplierOrder extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'supplier_orders';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = [
        'order',        
        'onwer',
        'supplier_id',
        'order_date',
        'incoterm',
        'forwarder',
        'port',      
        'etd', 
        'eta',
        'last_update',
        'due_date',
        'delivery_date',
        'payment_term',
        'observation',
        'destination',
        'country',
        'province',
        'city',
        'zip',
        'street',
        'street2',
        'products',
        'total_pallet',
        'total_net_weight',
        'currency',
        'amount',
        'status',  
    ];

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function supplierOrderItem()
    {
        return $this->hasMany(SupplierOrderItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplierOrderFile()
    {
        return $this->hasMany(SupplierOrderFile::class);
    }    
}
