<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('tax_id')->nullable();
            $table->foreignId('currency_id');
            $table->tinyInteger('status')->default(1);
            $table->string('model');
            $table->string('sku');
            $table->integer('quantity')->default(0);
            $table->decimal('oldprice',15,4)->default(0);
            $table->decimal('price',15,4)->default(0);
            $table->decimal('discount_price',15,4)->default(0);
            $table->decimal('purchase_price',15,4)->default(0);
            $table->decimal('purchase_discount',15,4)->default(0);
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('weight',15,4)->nullable();
            $table->decimal('length',15,4)->nullable();
            $table->decimal('width',15,4)->nullable();
            $table->decimal('height',15,4)->nullable();
            $table->string('tag')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
