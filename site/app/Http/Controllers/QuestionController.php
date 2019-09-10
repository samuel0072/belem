<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::all();
        return $questions;
    }

    public function store(Request $request)
    {
        $validated = $request->validated();
        return Question::create($validated);
    }


    public function show(Question $question)
    {
        return $question;
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validated();
        $question->update($validated);
        return $question;
    }

    public function destroy(Question $question)
    {

    }
}
