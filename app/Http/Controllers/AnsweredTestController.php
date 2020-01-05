<?php

namespace App\Http\Controllers;

use App\AnsweredTest;
use App\Http\Requests\AnsTestRequest;
use App\SchoolMember;
use App\Test;

class AnsweredTestController extends Controller
{
    //ninguém pode acessar essa rota
    public function index()
    {
        return response('not allowed', 403);
    }

    //salva um asnwered_test no db
    public function store(AnsTestRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        $id = $validated["school_member_id"];
        $answered = AnsweredTest::create($validated);
        return redirect("/schoolmember/$id");
    }

    //renderiza no front end
    public function show(AnsweredTest $answeredTest)
    {
        $this->authorize('view', $answeredTest);
        return view('ans_test.show', compact('answeredTest'));
    }

    //atualiza
    public function update(AnsTestRequest $request, AnsweredTest $answeredTest)
    {
        $this->authorize('update', $answeredTest);
        $validated = $request->validated();
        $answeredTest->update($validated);
        return $answeredTest;
    }

    //deleta
    public function destroy(AnsweredTest $answeredTest)
    {
        $this->authorize('delete', $answeredTest);//checa a autorização
        $answeredTest->delete();
        return $this->index();
    }

    //renderiza uma view para editar
    public function edit(AnsweredTest $answeredTest)
    {
        $this->authorize('update', $answeredTest);//checa a autorização
        return view("ans_test.edit", compact('answeredTest'));
    }

    //ninguém pode acessar a view de criação
    public function create()
    {
        return response('not allowed', 403);
    }

    //retorna o student associado(school_member)
    public function getStudent($answered_test_id)
    {
        $answeredTest = AnsweredTest::findOrFail($answered_test_id);//se falha retorna 404
        $this->authorize('view', $answeredTest);//checa a autorização

        $student = SchoolMember::findOrFail($answeredTest->school_member_id);
        return $student;
    }
    //retorna o test associado
    public function getTest($answered_test_id)
    {
        $answeredTest = AnsweredTest::findOrFail($answered_test_id);//se falha retorna 404
        $this->authorize('view', $answeredTest);//checa a autorização

        $test = Test::findOrFail($answeredTest->test_id);
        return $test;
    }
    //retorna as questões do test associado
    public function getTestQuestions($answered_test_id) {
        $test = $this->getTest($answered_test_id);//checa a autorização
        return $test->questions;
    }
}
