<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class File extends Model
{
    use HasFactory;

    // Indicate the name of the table
    protected $table = 'files';

    // Indicate which columns can be registered
    protected $fillable = ['original_name','file_name','file_path'];

    // Create polymorphic relationship between one and many
    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
