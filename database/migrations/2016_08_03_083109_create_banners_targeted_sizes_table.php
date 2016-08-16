<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTargetedSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_targeted_sizes', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('banner_id');
            $table->integer('size')->default(0);
            $table->timestamps();


            $table->foreign('banners')
                ->references('id')->on('banner_id')
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
        Schema::drop('banners_targeted_sizes');
    }
}
