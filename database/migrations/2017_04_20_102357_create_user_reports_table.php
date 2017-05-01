<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('manage_users_id')->unsigned()->refferences('id')->on('manage_users');
        $table->integer('report_by_user_id')->unsigned()->refferences('id')->on('manage_users');
        $table->integer('reason_id');
        $table->string('additional_info');
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
        Schema::dropIfExists('user_reports');
    }
}
