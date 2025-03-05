<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Metting extends Model
{
    use HasFactory;

    // Indicate the name of the table
    protected $table = 'mettings';

    // Indicate which columns can be registered
    protected $fillable = ['metting_name','metting_date', 'file', 'year'];

    // Create polymorphic relationship between one and many
    public function mettingable(): MorphTo
    {
        return $this->morphTo();
    }

}