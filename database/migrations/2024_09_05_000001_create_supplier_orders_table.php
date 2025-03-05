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
        Schema::create('supplier_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('supplier');
            $table->string('order')->nullable();
            $table->date('order_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('observation')->nullable();
            $table->string('file')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('delivery_country')->nullable();
            $table->string('delivery_province')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_zip')->nullable();
            $table->string('delivery_street')->nullable();
            $table->string('delivery_street2')->nullable();
            $table->float('total_amount')->nullable();  
            $table->float('total_weight')->nullable();
            $table->float('status')->default(1);
            $table->float('products')->nullable();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};
