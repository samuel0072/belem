<?php

namespace App\Http\Controllers;

use App\QuestionAnsweredTest;
use App\Http\Requests\QuestAnsTestRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class QuestionAnsweredTestController extends Controller
{

    /**
     * @return ResponseFactory|Response
     */
    public function index()
    {
        return response('not allowed', 403);
    }

    public function store(QuestAnsTestRequest $request)
    {
        $this->authorize('create', $request);
        $validated = $request->validated();
        $questionAnsweredTest = QuestionAnsweredTest::updateOrCreate(
            [
                'answered_test_id' => $validated['answered_test_id'],
                'question_id' => $validated['question_id'],
                'grade_class_id'=> $validated['grade_class_id']
            ],
            ['option_choosed' => $validated['option_choosed']]);
        return $questionAnsweredTest;
    }

    public function show(QuestionAnsweredTest $questionAnsweredTest)
    {
        $this->authorize('view', $questionAnsweredTest);
        return $questionAnsweredTest;
    }

    public function update(QuestAnsTestRequest $request)
    {
        return response('not allowed', 403);
    }

    public function destroy(QuestionAnsweredTest $questionAnsweredTest)
    {
        $this->authorize('delete', $questionAnsweredTest);
        $questionAnsweredTest->delete();
        return redirect('/', 200);
    }

    public function edit() {
        return response('not allowed', 403);
    }
}
