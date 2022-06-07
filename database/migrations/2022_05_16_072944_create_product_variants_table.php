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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('variant_id');
            $table->integer('variant_options_id');
            $table->string('sku');
            $table->integer('quantity');
            $table->decimal('price',15,4);
            $table->decimal('weight',15,4)->nullable();
            $table->decimal('length',15,4)->nullable();
            $table->decimal('width',15,4)->nullable();
            $table->decimal('height',15,4)->nullable();
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
        Schema::dropIfExists('product_variants');
    }
};
