<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function index()
    {
        $schools = School::all();
        return view('school.show' , compact('schools'));
    }

    public function create(){
        return view('school.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        School::create($validated);
        return $this->index();
    }


    public function show(School $school)
    {
        return view('school.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"]
        ]);
        $school->update($validated);
        return $school;
    }

    public function destroy(School $school)
    {
        $school->delete();
        return $this->index();
    }

    public function classes($id) {
        $school = School::findOrFail($id);
        $gradeClasses = $school->gradeClasses;

        return view("grade_class.show",compact('gradeClasses'));

    }

    public function edit(School $school) {
        return view('school.edit', compact('school'));
    }

}
