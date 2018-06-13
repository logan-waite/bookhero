<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        $table = DB::table('attributes');
        $table->insert(array(
          'id' => 1,
          'name' => 'Wisdom',
          'description' => 'Applying experiences (yours or others) to any situation',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 2,
          'name' => 'Imagination',
          'description' => 'Being able to look beyond the normal to see other possibilities.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 3,
          'name' => 'Creativity',
          'description' => 'Finding unique situations to the problems you face',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ));
        $table->insert(array(
          'id' => 4,
          'name' => 'Empathy',
          'description' => 'Feeling connected to and understanding of the people around you',
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
        Schema::dropIfExists('attributes');
    }
}
