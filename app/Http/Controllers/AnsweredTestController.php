<?php

namespace App\Http\Controllers;

use App\AnsweredTest;
use App\Http\Requests\AnsTestRequest;
use App\Question;
use App\SchoolMember;
use App\Test;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AnsweredTestController extends Controller
{
    /**
     * Essa rota nao e utilizada
     * @return ResponseFactory|Response
     */
    public function index()
    {
        return response('not allowed', 403);
    }

    /**
     * Cria um AnsweredTest no banco de dados
     * @param AnsTestRequest $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(AnsTestRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        $id = $validated["school_member_id"];
        $answered = AnsweredTest::create($validated);
        return redirect("/schoolmember/$id");
    }

    /**
     * Renderiza uma view para mostrar o AnsweredTest
     * @param AnsweredTest $answeredTest
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(AnsweredTest $answeredTest)
    {
        $this->authorize('view', $answeredTest);
        return view('ans_test.show', compact('answeredTest'));
    }

    /**
     * Atualiza o AnsweredTest
     * @param AnsTestRequest $request
     * @param AnsweredTest $answeredTest
     * @return AnsweredTest
     * @throws AuthorizationException
     */
    public function update(AnsTestRequest $request, AnsweredTest $answeredTest)
    {
        $this->authorize('update', $answeredTest);
        $validated = $request->validated();
        $answeredTest->update($validated);
        return $answeredTest;
    }

    /**
     * Deleta o AnsweredTest
     * @param AnsweredTest $answeredTest
     * @return ResponseFactory|Response
     * @throws AuthorizationException
     */
    public function destroy(AnsweredTest $answeredTest)
    {
        $this->authorize('delete', $answeredTest);//checa a autorização
        $answeredTest->delete();
        return $this->index();
    }

    /**
     * Renderiza uma view para editar
     * @param AnsweredTest $answeredTest
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(AnsweredTest $answeredTest)
    {
        $this->authorize('update', $answeredTest);
        return view("ans_test.edit", compact('answeredTest'));
    }

    /**
     * nao utilizado, mas ainda acessivel.
     * @return ResponseFactory|Response
     */
    public function create()
    {
        return response('not allowed', 403);
    }

    /**
     * Retorna o estudante associado
     * @param $answered_test_id
     * @return SchoolMember
     * @throws AuthorizationException
     */
    public function getStudent($answered_test_id)
    {
        $answeredTest = AnsweredTest::findOrFail($answered_test_id);
        $this->authorize('view', $answeredTest);

        $student = SchoolMember::findOrFail($answeredTest->school_member_id);
        return $student;
    }

    /**
     * retorna o test associado
     * @param $answered_test_id
     * @return Test
     * @throws AuthorizationException
     */
    public function getTest($answered_test_id)
    {
        $answeredTest = AnsweredTest::findOrFail($answered_test_id);//se falha retorna 404
        $this->authorize('view', $answeredTest);//checa a autorização

        $test = Test::findOrFail($answeredTest->test_id);
        return $test;
    }

    /**
     * Retorna as questoes do test associado
     * @param $answered_test_id
     * @return Question
     * @throws AuthorizationException
     */
    public function getTestQuestions($answered_test_id) {
        $test = $this->getTest($answered_test_id);//checa a autorização
        return $test->questions;
    }
}
