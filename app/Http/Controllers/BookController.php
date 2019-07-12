<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Events\onAddBookEvent;
use App\Events\onEditBookEvent;
use App\Http\Requests\AddBookRequest;
use App\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index() {

        $books = Book::all()->sortByDesc('created_at');
        $message = 'Все книги';

        return view('books.all')->with(['books'=>$books, 'message'=>$message]);
    }

    public function show($id) {

        $book = Book::find($id);
        $authors = Author::all()->sortBy('name')->sortBy('surname');
        $rubrics = Rubric::all()->sortBy('title');

        return view('books.show')->with(['book'=>$book, 'authors'=>$authors, 'rubrics' => $rubrics]);
    }

    public function add() {

        $this->authorize('addBook');

        $authors = Author::all()->sortBy('name')->sortBy('surname');
        $rubrics = Rubric::all()->sortBy('title');

        return view('books.add')->with(['authors'=>$authors, 'rubrics' => $rubrics]);
    }

    public function store(AddBookRequest $request) {

        $this->authorize('addBook');

        $image_path=$request->file('image')->storePublicly('public/images');
        $image_path=preg_replace( "#public/#", "", $image_path );

        $book = Book::create([
            'title' => $request->title,
            'image_path' => $image_path,
        ]);

        event(new onAddBookEvent($request,$book));

        return redirect()->route('showBook',['id' => $book->id]);
    }

    public function edit($id) {

        $this->authorize('editBook');

        $book = Book::find($id);
        $authors = Author::all()->sortBy('name')->sortBy('surname');
        $rubrics = Rubric::all()->sortBy('title');

        return view('books.edit')->with(['book'=>$book, 'authors'=>$authors, 'rubrics' => $rubrics]);
    }

    public function update(AddBookRequest $request) {

        $this->authorize('editBook');

        $book = Book::find($request->book_id);

        Storage::disk('public')->delete($book->image_path);

        $image_path=$request->file('image')->storePublicly('public/images');
        $image_path=preg_replace( "#public/#", "", $image_path );

        $book->update([
            'title' => $request->title,
            'image_path' => $image_path,
        ]);

        event(new onEditBookEvent($request,$book));

        return redirect()->route('showBook',['id' => $book->id]);
    }

    public function delete($id) {

        $this->authorize('deleteBook');

        $book = Book::find($id);

        Storage::disk('public')->delete($book->image_path);

        $book->delete();

        return redirect()->route('showAllBooks')->with('success', 'Книга успешно удалена');
    }
}
