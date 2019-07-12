<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_books', function (Blueprint $table) {
            $table->engine = 'Postgres';
            $table->bigIncrements('id');
            $table->bigInteger('rubric_id')->unsigned();
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubric_books');
    }
}
