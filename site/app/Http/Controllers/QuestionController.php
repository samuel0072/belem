<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Test;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::all();
        return view('question.show', compact('questions'));
    }

    public function create(){
        return redirect('/');
    }

    public function store(QuestionRequest $request)
    {
        $validated = $request->validated();
        Question::create($validated);
        $id = $validated["test_id"];
        return redirect("/test/$id");
    }


    public function show(Question $question)
    {
        return view('question.edit');
        return $question;
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $validated = $request->validated();
        $question->update($validated);
        return $question;
    }

    public function destroy(Question $question)
    {
        $question->delete();
    }

    public function optionCount($id) {
        $question = Question::findOrFail($id);
        $test = Test::findOrFail($question->test_id);
        $results = [];

        if($test->status == "ready") {
            $results = DB::table('question_answered_tests')
                ->selectRaw("option_choosed, COUNT(answered_test_id) as quantity")
                ->whereRaw("question_id = $question->id")
                ->groupBy("option_choosed")
                ->get();
        }
        return $results;
    }
}
