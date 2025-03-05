<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Presentation extends Model
{
    use HasFactory;

    // Indicate the name of the table
    protected $table = 'presentations';

    // Indicate wich columns can be registrered
    protected $fillable = ['presentation_name', 'presentation_date', 'file', 'year'];

    // Create polymorphic relationship between one and many
    public function presentationable(): MorphTo
    {
        return $this->morphTo();
    }
}