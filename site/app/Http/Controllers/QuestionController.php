<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;

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
}
