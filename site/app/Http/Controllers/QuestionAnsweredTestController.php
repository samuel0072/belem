<?php

namespace App\Http\Controllers;

use App\QuestionAnsweredTest;
use Illuminate\Http\Request;
use App\Http\Requests\QuestAnsTestRequest;

class QuestionAnsweredTestController extends Controller
{

    public function index()
    {
        $record = QuestionAnsweredTest::all();
        return $record;
    }

    public function store(QuestAnsTestRequest $request)
    {
        $validated = $request->validated();
        return QuestionAnsweredTest::create($validated);
    }

    public function show(QuestionAnsweredTest $questionAnsweredTest)
    {
        return $questionAnsweredTest;
    }

    public function update(QuestAnsTestRequest $request, QuestionAnsweredTest $questionAnsweredTest)
    {
        $validated = $request->validated();
        $questionAnsweredTest->update($validated);
        return $questionAnsweredTest;
    }

    public function destroy(QuestionAnsweredTest $questionAnsweredTest)
    {
        $questionAnsweredTest->delete();
    }
}
