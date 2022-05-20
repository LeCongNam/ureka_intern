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
            $table->id();
            $table->integer('group_id')->default(2)->nullable(false)->index();
            $table->string('group_name')->nullable(false);

            $table->timestamp("created_at")->nullable();
            $table->timestamp("updated_at")->nullable();

            $table->integer("is_delete")->nullable();
            $table->softDeletes()->nullable();
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
