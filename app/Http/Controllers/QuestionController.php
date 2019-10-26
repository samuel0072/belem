<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Test;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function store(QuestionRequest $request)
    {
        $validated = $request->validated();
        $this->authorize('create');

        Question::create($validated);
        $id = $validated["test_id"];
        return redirect("/test/$id");
    }


    public function show(Question $question)
    {
        $this->authorize('view', $question);
        return view('question.edit', compact('question'));
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $validated = $request->validated();
        $this->authorize('update', $question);
        $question->update($validated);
        return $question;
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
    }

    public function optionCount($id) {
        $question = Question::findOrFail($id);
        $this->authorize('view', $question);

        $test = Test::findOrFail($question->test_id);
        $results = [];

        $results = DB::table('question_answered_tests')
            ->selectRaw("option_choosed, COUNT(answered_test_id) as quantity")
            ->whereRaw("question_id = $question->id")
            ->groupBy("option_choosed")
            ->get();
        return $results;
    }

    /*public function index()
    {

        $questions = Question::all();
        return view('question.show', compact('questions'));
    }*/

    /*public function create(){
       return redirect('/');
   }*/
}
