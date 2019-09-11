<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::all();
        return $questions;
    }

    public function store(QuestionRequest $request)
    {
        $validated = $request->validated();
        return Question::create($validated);
    }


    public function show(Question $question)
    {
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

        if($test->status == "ready") {
            $results = DB::selectRaw
        }
    }
}
