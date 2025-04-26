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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable()->index();
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->foreignId('category_id');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('qty')->default(0);
            $table->boolean('featured')->default(false);
            $table->boolean('is_visible')->default(false);
            $table->integer('old_price')->nullable();
            $table->integer('price')->nullable();
            $table->integer('cost')->nullable();
            $table->date('published_at')->nullable();
            $table->string('seo_title', 60)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->decimal('weight', 12, 2)->nullable()->default(0.00) ->unsigned();
            $table->decimal('height', 12, 2)->nullable()->default(0.00) ->unsigned();
            $table->decimal('width', 12, 2)->nullable()->default(0.00)->unsigned();
            $table->decimal('depth', 12, 2)->nullable()->default(0.00)->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
