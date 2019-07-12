<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRubricRequest;
use App\Rubric;
use Illuminate\Http\Request;

class RubricController extends Controller
{
    public function index() {

        $rubrics = Rubric::all()->sortByDesc('created_at');
        $message = 'Все рубрики';
        $n = 1;

        return view('rubrics.index')->with(['rubrics'=>$rubrics, 'message'=>$message, 'n' => $n]);
    }

    public function show($id) {

        $rubric = Rubric::find($id);
        $books = $rubric->books;

        return view('rubrics.show')->with(['rubric'=>$rubric, 'books'=>$books]);
    }

    public function store(AddRubricRequest $request) {

        $this->authorize('addRubric');

        Rubric::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Успешно');
    }

    public function update(AddRubricRequest $request) {

        $this->authorize('editRubric');

        $rubric = Rubric::find($request->rubric_id);

        $rubric->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Успешно');
    }

    public function delete($id) {

        $this->authorize('deleteRubric');

        $rubric = Rubric::find($id);

        $rubric->delete();

        return redirect()->back()->with('success', 'Успешно');
    }

}
