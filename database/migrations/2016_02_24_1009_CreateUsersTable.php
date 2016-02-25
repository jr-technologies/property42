<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('phone');
            $table->string('mobile');
            $table->string('fax');
            $table->string('address');
            $table->string('zipcode');
            $table->integer('country_id')->unsigned();
            $table->tinyInteger('notification_settings');
            $table->integer('membership_plane_id')->unsigned();
            $table->integer('membership_status');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
            $table->foreign('membership_plane_id')
                ->references('id')->on('membership_planes')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
