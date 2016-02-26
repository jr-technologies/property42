<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('feature');
            $table->integer('feature_section_id')->unsigned();
            $table->string('item_type');
            $table->integer('prority');
            $table->integer('property_feature_validation_role_id')->unsigned();
            $table->string('value');
            $table->timestamps();


            $table->foreign('feature_section_id')
                ->references('id')->on('feature_sections')
                ->onDelete('cascade');

            $table->foreign('property_feature_validation_role_id')
                ->references('id')->on('property_feature_validation_rules')
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
        Schema::drop('property_features');
    }
}
