<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\Http\Requests\GradeClassRequest;

class GradeClassController extends Controller
{

    public function index()
    {
        $grade_classes = GradeClass::all();
        return $grade_classes;
    }

    public function store(GradeClassRequest $request)
    {
        $validated = $request->validated();
        return GradeClass::create($validated);
    }


    public function show()
    {
        $gradeClasses = $this->index();
        return view('grade_class.show', compact('gradeClasses'));
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
}
