<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class ProductFile extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    // Indicar o nome da tabela
    protected $table = 'product_files';

    // Indicar quais colunas podem ser cadastrada
     protected $fillable = ['name', 'type' ,'file' ,'product', 'product_id', 'year'];

    // // Criar relacionamento entre um e muitos
    // public function productDocument()
    // {
    //     return $this->hasMany(ProductDocument::class);
    // }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

