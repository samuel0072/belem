<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\Http\Requests\SchoolMemberRequest;
use App\SchoolMember;
use App\UserGradeClass;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SchoolMemberController extends Controller
{

    /**
     * Metodo nao utilizado
     * @return RedirectResponse|Redirector
     */
    public function index()
    {
       return redirect('/', 403);
    }

    /**
     * Cria um SchoolMember
     * @param SchoolMemberRequest $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(SchoolMemberRequest $request)
    {
        $this->authorize('create', SchoolMember::class);
        $validated = $request->validated();
        $id = $validated['grade_class_id'];
        SchoolMember::create($validated);
        return redirect("/grade_class/$id/students");
    }

    /**
     * Renderiza uma view para mostrar o SchoolMember
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $student = SchoolMember::findOrFail($id);
        $this->authorize('view', $student);
        return view('school_member.show', compact('student'));
    }

    /**
     * Atualiza o SchoolMember
     * @param SchoolMemberRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(SchoolMemberRequest $request, $id)
    {
        $schoolMember = SchoolMember::findOrFail($id);
        $this->authorize('update', $schoolMember);
        $validated = $request->validated();
        $schoolMember->update($validated);
        return redirect("/grade_class/$schoolMember->grade_class_id/students");
    }

    /**
     * Deleta o SchoolMember
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        $schoolMember = SchoolMember::findOrFail($id);

        $this->authorize('delete', $schoolMember);
        $class = $schoolMember->grade_class_id;
        $schoolMember->delete();
        return redirect("/grade_class/$class/students");
    }

    /** Renderiza uma view para editar
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit($id) {
        $schoolMember = SchoolMember::findOrFail($id);
        $this->authorize('update', $schoolMember);
        return view("school_member.edit", compact('schoolMember'));
    }

    /**
     * Renderiza uma view para criar
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create() {
        $this->authorize('create');
        return view("school_member.create");
    }

    /**
     * Retorna os AnsweredTest do aluno
     * @param int $id
     * @return SchoolMember[]
     * @throws AuthorizationException
     */
    public function answeredTests($id) {
        $student = SchoolMember::findOrFail($id);
        $this->authorize('viewAnsTests', $student);
        return $student->answeredTests;
    }

    /**
     * Renderiza uma view para exibir os AnsweredTest do aluno
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function showAnsweredTests($id) {
        $answeredTests = $this->answeredTests($id);
        $student = $this->show(SchoolMember::findOrFail($id));
        $this->authorize('view', $student);

        return view('ans_test.showAll', compact(['answeredTests', 'student']));
    }

    /**
     * Retorna o score do aluno referente a um descritor
     * @param int $student_id
     * @param int $test_id
     * @param int $topic_id
     * @return float|int
     * @throws AuthorizationException
     */
    public function getTopicScore($student_id, $test_id, $topic_id) {
        $student = SchoolMember::findOrFail($student_id);
        $this->authorize('viewTopicScore', $student);
        $score = (new TestController)->topicCount($test_id, $topic_id, $student_id);
        return $score;
    }

    /**
     * Retorna o SchoolMember pela matricula
     * @param int $enroll
     * @return SchoolMember
     * @throws AuthorizationException
     */
    public function getMemberbyEnroll($enroll) {
        $member = SchoolMember::where('enroll', $enroll) ->get();
        $this->authorize('view', $member);
        return $member;
    }

}
