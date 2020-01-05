<?php

namespace App\Http\Controllers;

use App\QuestionAnsweredTest;
use App\Http\Requests\QuestAnsTestRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class QuestionAnsweredTestController extends Controller
{

    /**
     * Metodo nao utilizado
     * @return ResponseFactory|Response
     */
    public function index()
    {
        return response('not allowed', 403);
    }

    /**
     * Cria e Retorna um QuestionAnsweredTest
     * @param QuestAnsTestRequest $request
     * @return QuestionAnsweredTest
     * @throws AuthorizationException
     */
    public function store(QuestAnsTestRequest $request)
    {
        $this->authorize('create', $request);
        $validated = $request->validated();
        $questionAnsweredTest = QuestionAnsweredTest::updateOrCreate(//Tenta atualizar, se não, cria.
            [
                'answered_test_id' => $validated['answered_test_id'],
                'question_id' => $validated['question_id'],
                'grade_class_id'=> $validated['grade_class_id']
            ],
            ['option_choosed' => $validated['option_choosed']]);
        return $questionAnsweredTest;
    }

    /**
     * Retorna o QuestionAnsweredTest
     * @param QuestionAnsweredTest $questionAnsweredTest
     * @return QuestionAnsweredTest
     * @throws AuthorizationException
     */
    public function show(QuestionAnsweredTest $questionAnsweredTest)
    {
        $this->authorize('view', $questionAnsweredTest);
        return $questionAnsweredTest;
    }

    /**
     * Atualiza o QuestionAnsweredTest
     * @param QuestAnsTestRequest $request
     * @return ResponseFactory|Response
     */
    public function update(QuestAnsTestRequest $request)
    {
        return response('not allowed', 403);
    }

    /**
     * Deleta o QuestionAnsweredTest
     * @param QuestionAnsweredTest $questionAnsweredTest
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(QuestionAnsweredTest $questionAnsweredTest)
    {
        $this->authorize('delete', $questionAnsweredTest);
        $questionAnsweredTest->delete();
        return redirect('/', 200);
    }

    /**
     * Metodo nao utilizado
     * @return ResponseFactory|Response
     */
    public function edit() {
        return response('not allowed', 403);
    }
}
