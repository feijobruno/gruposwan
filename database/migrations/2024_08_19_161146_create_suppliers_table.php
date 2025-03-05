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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier');
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('vat')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('bank_id_acc_number')->nullable();
            $table->string('bank_swift')->nullable();
            $table->string('bank_iban')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
