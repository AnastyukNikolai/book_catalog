<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('title')->unique();
            $table->timestamps();
        });

        DB::table('rubrics')->insert([
            ['title' => 'Культура'],
            ['title' => 'История'],
            ['title' => 'Бизнес'],
            ['title' => 'Природа'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubrics');
    }
}
