<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contact extends Model
{
    use HasFactory;

    // Indicate the name of the table
    protected $table = 'contacts';

    // Indicate which columns can be registered
    protected $fillable = ['name', 'phone', 'email', 'position', 'post'];

    // Create polymorphic relationship between one and many

    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }

}
