<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('level')->default(0);
            $table->integer('experience')->default(0);
            $table->timestamps();
        });

        Schema::table('user_attributes', function ($table) {
            $table->foreign('user_id')
              ->references('id')->on('users')
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
        Schema::dropIfExists('user_attributes');
    }
}
