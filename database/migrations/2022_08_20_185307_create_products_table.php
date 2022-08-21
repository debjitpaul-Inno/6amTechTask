<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->uuid('uuid');

            $table->string('title',50)->nullable();
            $table->string('uom',50)->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price')->nullable();
            $table->double('quantity')->nullable();
            $table->string('model',20)->nullable();
            $table->string('brand',20)->nullable();
            $table->string('color',20)->nullable();
            $table->string('status',20)->default('active');

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
}
