<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\Http\Requests\GradeClassRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;


class GradeClassController extends Controller
{

    /**
     * Mostra as classes do usuário. Se for admin mostra todas as classes
     *
     * @return Factory|View
     * */
    public function index()
    {
        $user = auth()->user();
        $gradeClasses = [];
        if($user->acess_level > 2) {// se o usuario for admin ele retorna todas as classes, todo: mudar para somente classes da scola
            $gradeClasses = GradeClass::all();
        }
        else {
            $gradeClasses = $user->classes();// se não retorna só as classes do usuario, todo: alterar para diretor ter todas as classes da escola
        }

        return view('grade_class.show', compact('gradeClasses'));
    }

    /**
     * Retorna a classe
     * @param int $gradeClassId , id da classe
     * @return App\GradeClass
     *
     * @throws AuthorizationException
     */
    public function show($gradeClassId){
        $gradeClass = GradeClass::findOrFail($gradeClassId);
        $this->authorize('view', $gradeClass);
        return $gradeClass;
    }

    /**
     *  Cria uma classe no banco
     * @param App\Http\Requests\GradeClassRequest $request
     * @return RedirectResponse|Redirector
     *
     * @throws AuthorizationException
     */
    public function store(GradeClassRequest $request)
    {
        $this->authorize('create', GradeClass::class);
        $validated = $request->validated();
        GradeClass::create($validated);
        $id = $validated["school_id"];
        return redirect("/school/$id/classes");//Mostra as classes da escola
    }


    /**
     *  Atualiza as informações de uma classe
     * @param GradeClassRequest $request
     * @param GradeClass $gradeClass
     * @return RedirectResponse|Redirector
     *
     * @throws AuthorizationException
     */
    public function update(GradeClassRequest $request, GradeClass $gradeClass)
    {
        $this->authorize('update', $gradeClass);
        $validated = $request->validated();
        $gradeClass->update($validated);
        $id = $validated["school_id"];
        return redirect("/school/$id/classes");//Mostra as classes da escola
    }

    /**
     *  Renderiza uma view de criação de classes
     * @return Factory|View
     *
     * @throws AuthorizationException
     */
    public function create(){
        $this->authorize('create', GradeClass::class);
        return view('grade_class.create');
    }

    /**
     *  Deleta a classe
     * @param GradeClass $gradeClass
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(GradeClass $gradeClass)
    {
        $this->authorize('delete', $gradeClass);
        $id = $gradeClass->school_id;
        $gradeClass->delete();
        return redirect("/school/$id/classes");
    }

    /**
     *  Retorna os estudantes da classe(school_members)
     * @param int $id , id da classe
     * @return array App\SchoolMember
     *
     * @throws AuthorizationException
     */
    public function classMembers($id) {
        $class = GradeClass::findOrFail($id);
        $this->authorize('view', $class);//mesma logica de ver os dados de uma classe
        $students = $class->schoolMembers;
        return $students;
    }

    /**
     *  Retorna os testes associados a uma classe
     * @param int $id , id da classe
     * @return array App\Test
     *
     * @throws AuthorizationException
     */

    public function tests($id) {
        $class = GradeClass::findOrFail($id);
        $this->authorize('view', $class);//mesma logica de ver os dados de uma classe
        return $class->tests;
    }

    /**
     *  Renderiza uma view com os estudantes da clsse
     * @param int $id , id da classe
     * @return Factory|View
     *
     * @throws AuthorizationException
     */
    public function showClassMembers($id) {
        $students = $this->classMembers($id);
        return view("school_member.showAll", compact(['students', 'id']));
    }

    /**
     *  Renderiza uma view com os testes da clsse
     * @param int $id , id da classe
     * @return Factory|View
     *
     * @throws AuthorizationException
     */
    public function showTests($id) {
        $tests = $this->tests($id);
        return view("test.showAll", compact(['tests', 'id']));
    }
}
