<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Supplier extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'suppliers';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['supplier', 'country', 'province', 'zip', 'city', 'street', 'street2', 'email', 'phone', 'vat', 'bank_id', 'bank_id_acc_number', 'bank_swift', 'bank_iban'];
    
    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
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
