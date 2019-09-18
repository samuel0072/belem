<?php

namespace App\Http\Controllers;

use App\QuestionAnsweredTest;
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
        $questionAnsweredTest = QuestionAnsweredTest::updateOrCreate([
            'answered_test_id' => $validated['answered_test_id'],
            'question_id' => $validated['question_id'],
            'option_choosed' => $validated['option_choosed']
        ]);
        return $questionAnsweredTest;
    }

    public function show(QuestionAnsweredTest $questionAnsweredTest)
    {
        return $questionAnsweredTest;
    }

    public function update(QuestAnsTestRequest $request)
    {
        return redirect("/");
    }

    public function destroy(QuestionAnsweredTest $questionAnsweredTest)
    {
        $questionAnsweredTest->delete();
    }
}
