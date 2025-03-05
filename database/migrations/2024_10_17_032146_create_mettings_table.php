<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mettings', function (Blueprint $table) {
            $table->id();
            $table->string('metting_name');
            $table->date('metting_date');
            $table->string('file')->nullable();
            $table->integer('year');
            $table->morphs('mettingable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metting');
    }
};

/**
* 
* php artisan migrate --path=/database/migrations/2024_10_17_032146_create_metting_table.php
*/