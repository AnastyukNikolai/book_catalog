<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'image_path'];

    public function authors() {
        return $this -> belongsToMany('App\Author', 'author_books');
    }

    public function rubrics() {
        return $this -> belongsToMany('App\Rubric', 'rubric_books');
    }
}
