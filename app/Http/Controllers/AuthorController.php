<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AddAuthorRequest;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {

        $authors = Author::all()->sortByDesc('created_at');
        $message = 'Все авторы';
        $n = 1;

        return view('authors.index')->with(['authors'=>$authors, 'message'=>$message, 'n' => $n]);
    }

    public function show($id) {

        $author = Author::find($id);
        $books = $author->books;

        return view('authors.show')->with(['author'=>$author, 'books'=>$books]);
    }

    public function store(AddAuthorRequest $request) {

        $this->authorize('addAuthor');

        Author::create([
            'name' => $request->name,
            'surname' => $request->surname,
        ]);

        return redirect()->back()->with('success', 'Успешно');
    }

    public function update(AddAuthorRequest $request) {

        $this->authorize('editAuthor');

        $author = Author::find($request->author_id);

        $author->update([
            'name' => $request->name,
            'surname' => $request->surname,
        ]);

        return redirect()->back()->with('success', 'Успешно');
    }

    public function delete($id) {

        $this->authorize('deleteAuthor');

        $author = Author::find($id);

        $author->delete();

        return redirect()->back()->with('success', 'Успешно');
    }
}

