<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use \OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    // Indicar o nome da tabela
    protected $table = 'products';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['product', 'packaging_type' ,'kg' ,'qty_pallet', 'kg_pallet', 'dangerous_material' ,'supplier_id'];

    // // Criar relacionamento entre um e muitos
    // public function productDocument()
    // {
    //     return $this->hasMany(ProductDocument::class);
    // }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function document()
    {
        return $this->hasMany(ProductFile::class);
    }
    
    public function mettings(): MorphMany
    {
        return $this->morphMany(Metting::class, 'mettingable');
    }

    public function presentations(): MorphMany
    {
        return $this->morphMany(Presentation::class, 'presentationable');
    }
}

