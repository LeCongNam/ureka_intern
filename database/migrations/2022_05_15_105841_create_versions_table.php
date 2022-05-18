<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->string('product_id')->nullable(false);
            $table->string('product_name')->nullable(false);
            $table->string('product_type')->nullable(false);
            $table->string('desc')->nullable(false);
            $table->string('url')->nullable(false);
            $table->string('icon')->nullable()->default(null);
            $table->date("created_at")->nullable();
            $table->date("updated_at")->nullable();
            $table->boolean("is_delete")->nullable();
            $table->date("deleted_at")->nullable();

            $table->unique(['product_id','product_type']);
            $table->foreign('product_id')->references('product_id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versions');
    }
}
