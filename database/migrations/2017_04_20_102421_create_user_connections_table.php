<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_connections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manage_users_id')->unsigned()->refferences('id')->on('manage_users');
            $table->integer('wink_user_id')->unsigned()->refferences('id')->on('manage_users');
            $table->integer('added_user_id')->unsigned()->refferences('id')->on('manage_users');
            $table->string('gift');
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
        Schema::dropIfExists('user_connections');
    }
}
