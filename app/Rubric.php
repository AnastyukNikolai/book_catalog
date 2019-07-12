<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    protected $fillable = ['title'];

    public function books() {
        return $this -> belongsToMany('App\Book', 'rubric_books');
    }
}
