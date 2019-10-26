<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\Http\Requests\GradeClassRequest;

class GradeClassController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $gradeClasses = [];
        if($user->acess_level > 2) {
            $gradeClasses = GradeClass::all();
        }
        else {
            $gradeClasses = $user->classes();
        }

        return view('grade_class.show', compact('gradeClasses'));
    }

    public function show($gradeClassId){
        $gradeClass = GradeClass::findOrFail($gradeClassId);
        $this->authorize('view', $gradeClass);
        return $gradeClass;
    }
    public function store(GradeClassRequest $request)
    {
        $this->authorize('create', GradeClass::class);
        $validated = $request->validated();
        GradeClass::create($validated);
        $id = $validated["school_id"];
        return redirect("/school/$id/classes");
    }

    public function update(GradeClassRequest $request, GradeClass $gradeClass)
    {
        $this->authorize('update', $gradeClass);
        $validated = $request->validated();
        $gradeClass->update($validated);
        $id = $validated["school_id"];
        return redirect("/school/$id/classes");
    }

    public function create(){
        $this->authorize('create', GradeClass::class);
        return view('grade_class.create');
    }

    public function destroy(GradeClass $gradeClass)
    {
        $this->authorize('delete', $gradeClass);
        $id = $gradeClass->school_id;
        $gradeClass->delete();
        return redirect("/school/$id/classes");
    }

    public function classMembers($id) {
        $class = GradeClass::findOrFail($id);
        $this->authorize('view', $class);//mesma logica de ver os dados de uma classe
        $students = $class->schoolMembers;
        return $students;
    }

    public function tests($id) {
        $class = GradeClass::findOrFail($id);
        $this->authorize('view', $class);//mesma logica de ver os dados de uma classe
        return $class->tests;
    }
    //aqui não precisa colocar autorização
    //meu teclado ta bugado
    public function showClassMembers($id) {
        $students = $this->classMembers($id);
        return view("school_member.showAll", compact(['students', 'id']));
    }

    public function showTests($id) {
        $tests = $this->tests($id);
        return view("test.showAll", compact(['tests', 'id']));
    }
}
