<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // Seed some authors for testing
        $table = DB::table('authors');
        $table->insert(array(
          'id' => 1,
          'name' => 'Brandon Sanderson',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 2,
          'name' => 'Jules Verne',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 3,
          'name' => 'Paulo Coelho',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
