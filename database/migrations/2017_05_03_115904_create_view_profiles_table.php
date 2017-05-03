<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manage_users_id')->unsigned()->refferences('id')->on('manage_users');
            $table->integer('viewer_users_id')->unsigned()->refferences('id')->on('manage_users');
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
        Schema::dropIfExists('view_profiles');
    }
}
