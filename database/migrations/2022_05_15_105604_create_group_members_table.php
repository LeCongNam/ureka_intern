<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->integer('group_id')->default(1)->nullable()->index();
            $table->string('group_name')->nullable(false);
            $table->date("created_at")->nullable();
            $table->date("updated_at")->nullable();

            $table->boolean("is_delete")->nullable();
            $table->date("deleted_at")->nullable();
            $table->unique(['group_id','group_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_members');
    }
}
