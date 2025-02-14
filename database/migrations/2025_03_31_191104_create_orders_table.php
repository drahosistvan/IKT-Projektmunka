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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'cancelled'])->default('new');
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('email')->nullable();
            $table->string('billing_name');
            $table->string('billing_country');
            $table->string('billing_street');
            $table->string('billing_city');
            $table->string('billing_zip');
            $table->string('shipping_name');
            $table->string('shipping_country');
            $table->string('shipping_street');
            $table->string('shipping_city');
            $table->string('shipping_zip');
            $table->integer('total_price');
            $table->integer('shipping_price');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
