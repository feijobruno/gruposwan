<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Customer extends Model
{
    use HasFactory;
    
    // Specify the table name
    protected $table = 'customers';

    // Indicate which columns can be registered
    protected $fillable = [
        'customer',
        'email',
        'phone',
        'vat',
        'bank_id',
        'bank_id_acc_number',
        'bank_swift',
        'bank_iban',
        'country',
        'province',
        'zip',
        'city',
        'street',
        'street2',
        'delivery_country',
        'delivery_province',
        'delivery_zip',
        'delivery_city',
        'delivery_street',
        'delivery_street2'
    ];

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function customerOrder()
    {
        return $this->belongsTo(CustomerOrder::class);
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
