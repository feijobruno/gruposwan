<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Country extends Model
{
    use HasFactory;

    // Indicate the name of the table
    protected $table = 'countries';

    // Indicate which columns can be registered
    protected $fillable = ['country_code', 'country', 'code', 'status'];

}
