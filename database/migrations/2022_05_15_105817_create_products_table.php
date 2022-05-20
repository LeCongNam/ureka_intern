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
            $table->string('product_id')->nullable(false);
            $table->string('product_name')->nullable(false);

            $table->date("created_at")->nullable();
            $table->date("updated_at")->nullable();

            $table->integer("is_delete")->nullable();
            $table->softDeletes()->nullable();

            $table->unique(['product_id', 'product_name']);
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
