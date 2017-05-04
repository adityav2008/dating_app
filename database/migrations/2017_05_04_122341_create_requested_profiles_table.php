<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestedProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requested_users_id')->unsigned()->refferences('id')->on('manage_users');
            $table->integer('send_users_id')->unsigned()->refferences('id')->on('manage_users');
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
        Schema::dropIfExists('requested_profiles');
    }
}
