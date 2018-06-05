<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('author_id');
            $table->text('summary');
            $table->string('cover_file_path')->nullable();
            $table->timestamps();
        });

        // Seed some books for testing
        $table = DB::table('books');
        $table->insert(array(
          'id' => 1,
          'title' => 'Around the World in 80 Days',
          'author_id' => 2,
          'summary' => 'Man takes a bet to travel around the world in 80 days using the technology of the time.',
          'cover_file_path' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 2,
          'title' => 'The Way of Kings',
          'author_id' => 1,
          'summary' => 'War is happening in Roshar. What will the people do?',
          'cover_file_path' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 3,
          'title' => 'Journey to the Center of the Earth',
          'author_id' => 2,
          'summary' => 'What lies at the center of the earth?',
          'cover_file_path' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 4,
          'title' => 'The Alchemist',
          'author_id' => 3,
          'summary' => 'Go on a journey of magic and discovery in search of the Alchemist.',
          'cover_file_path' => null,
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
        Schema::dropIfExists('books');
    }
}
