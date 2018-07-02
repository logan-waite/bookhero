<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateBookAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('value')->default('0');
            $table->timestamps();
        });

        Schema::table('book_attributes', function ($table) {
            $table->foreign('book_id')
              ->references('id')->on('books')
              ->onDelete('cascade');

            $table->foreign('attribute_id')
              ->references('id')->on('attributes')
              ->onDelete('cascade');
        });

        // $table = DB::table('book_attributes');
        // $table->insert(array(
        //   'id' => 1,
        //   'book_id' => 1,
        //   'attribute_id' => 1,
        //   'value' => 4,
        //   'created_at' => Carbon::now(),
        //   'updated_at' => Carbon::now()
        // ));
        // $table->insert(array(
        //   'id' => 2,
        //   'book_id' => 1,
        //   'attribute_id' => 2,
        //   'value' => 2,
        //   'created_at' => Carbon::now(),
        //   'updated_at' => Carbon::now()
        // ));
        // $table->insert(array(
        //   'id' => 3,
        //   'book_id' => 2,
        //   'attribute_id' => 1,
        //   'value' => 5,
        //   'created_at' => Carbon::now(),
        //   'updated_at' => Carbon::now()
        // ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_attributes');
    }
}
