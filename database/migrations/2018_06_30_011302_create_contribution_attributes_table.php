<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contribution_id')->unsigned()->nullable(false);
            $table->integer('attribute_id')->unsigned()->nullable(false);
            $table->integer('value')->nullable(false);
            $table->timestamps();
        });

        Schema::table('contribution_attributes', function ($table) {
            $table->foreign('contribution_id')
              ->references('id')->on('contributions')
              ->onDelete('cascade');

            $table->foreign('attribute_id')
              ->references('id')->on('attributes')
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
        Schema::dropIfExists('contribution_attributes');
    }
}
