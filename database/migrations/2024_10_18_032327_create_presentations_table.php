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
        Schema::create('presentations', function (Blueprint $table) {
            $table->id();
            $table->string('presentation_name');
            $table->date('presentation_date');
            $table->string('file')->nullable();
            $table->integer('year');
            $table->morphs('presentationable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentations');
    }
};

/**
 * 
 * php artisan migrate --path=/database/migrations/2024_10_18_032327_create_presentations_table.php
 */