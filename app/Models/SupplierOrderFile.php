<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SupplierOrderFile extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'supplier_order_files';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['file', 'order_id'];

    public function supplierOrder()
    {
        return $this->belongsTo(SupplierOrder::class);
    }

}
