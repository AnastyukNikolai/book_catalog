<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->String('name');
            $table->String('surname');
            $table->timestamps();
        });

        DB::table('authors')->insert([
            ['name' => 'Сергей', 'surname' => 'Иванов'],
            ['name' => 'Дмитрий', 'surname' => 'Кукишев'],
            ['name' => 'Александр', 'surname' => 'Сидоров'],
            ['name' => 'Михаил', 'surname' => 'Ярощук'],
        ]);
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
