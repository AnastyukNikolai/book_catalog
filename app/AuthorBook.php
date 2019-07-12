<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    protected $fillable = [ 'author_id', 'book_id'];
}
