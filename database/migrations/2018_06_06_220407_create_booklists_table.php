<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('book_lists', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->nullable(false);
          $table->integer('book_id')->unsigned()->nullable(false);
          $table->boolean('currently_reading')->default(false);
          $table->boolean('finished')->default(false);
          $table->timestamps();
      });

      Schema::table('book_lists', function ($table) {
          $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');

          $table->foreign('book_id')
            ->references('id')->on('books')
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
        Schema::dropIfExists('booklists');
    }
}
