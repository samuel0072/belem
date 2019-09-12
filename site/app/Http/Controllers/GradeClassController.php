<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\Http\Requests\GradeClassRequest;

class GradeClassController extends Controller
{

    public function index()
    {
        $gradeClasses = GradeClass::all();
        return view('grade_class.show', compact('gradeClasses'));
    }

    public function store(GradeClassRequest $request)
    {
        $validated = $request->validated();
        return GradeClass::create($validated);
    }

    public function update(GradeClassRequest $request, GradeClass $gradeClass)
    {
        $validated = $request->validated();
        $gradeClass->update($validated);
        return $gradeClass;
    }


    public function destroy(GradeClass $gradeClass)
    {
        $gradeClass->delete();
        return $this->index();
    }

    public function classMembers($id) {
        $class = GradeClass::findOrFail($id);
        $students = $class->schoolMembers;
        return $students;
    }

    public function tests($id) {
        $class = GradeClass::findOrFail($id);
        return $class->tests;
    }

    public function showClassMembers($id) {
        $students = $this->classMembers($id);
        return view("school_member.showAll", compact('students'));
    }

    public function showTests($id) {
        $tests = $this->tests($id);
        return view("test.showAll", compact('tests'));
    }
}
