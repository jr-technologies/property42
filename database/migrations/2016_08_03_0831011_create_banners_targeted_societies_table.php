<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTargetedSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_targeted_societies', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('banner_id');
            $table->integer('society_id');
            $table->timestamps();


            $table->foreign('banners')
                ->references('id')->on('banner_id')
                ->onDelete('cascade');

            $table->foreign('societies')
                ->references('id')->on('society_id')
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
        Schema::drop('banners_targeted_societies');
    }
}
