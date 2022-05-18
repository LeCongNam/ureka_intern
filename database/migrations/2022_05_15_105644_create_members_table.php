<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('password')->nullable(false);
            $table->integer('group_id')->nullable()->default(1);
            $table->date("created_at")->nullable();
            $table->date("updated_at")->nullable();
            $table->boolean("is_delete")->nullable();
            $table->date("deleted_at")->nullable();

            $table->unique(['id','user_name','email']);
            $table->foreign('group_id')->references('group_id')->on('group_members');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
