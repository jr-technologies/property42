<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('purpose_id')->unsigned();  //completed
            $table->integer('property_sub_type_id')->unsigned();  //completed
            $table->integer('block_id')->unsigned();  //complete
            $table->string('title');
            $table->text('description');
            $table->double('price');
            $table->double('land_area');
            $table->integer('land_unit_id')->unsigned();    //complete
            $table->integer('property_status_id')->unsigned();    //complete
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_hot')->default(0);
            $table->integer('total_views');
            $table->integer('rating');
            $table->integer('total_likes');
            $table->softDeletes();
            $table->integer('deleted_by')->unsigned();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('purpose_id')
                ->references('id')->on('property_purposes')
                ->onDelete('cascade');
            $table->foreign('property_sub_type_id')
                ->references('id')->on('property_sub_types')
                ->onDelete('cascade');
            $table->foreign('block_id')
                ->references('id')->on('blocks')
                ->onDelete('cascade');
            $table->foreign('land_unit_id')
                ->references('id')->on('land_units')
                ->onDelete('cascade');
            $table->foreign('property_status_id')
                ->references('id')->on('property_statuses')
                ->onDelete('cascade');
            $table->foreign('deleted_by')
                ->references('id')->on('users')
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
        Schema::drop('properties');
    }
}
