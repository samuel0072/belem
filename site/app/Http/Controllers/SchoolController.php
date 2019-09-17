<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /*
     * Funções que retornam dados
     * */
    public function index(){
        $schools = School::all();
        return view('school.show' , compact('schools'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        School::create($validated);
        redirect("/");
    }

    public function update(Request $request, School $school){
        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        $school->update($validated);
        return redirect("/");
    }

    public function destroy(School $school){
        $school->delete();
        return redirect("/");
    }

    public function classes($id) {
        $school = School::findOrFail($id);
        $gradeClasses = $school->gradeClasses;

        return $gradeClasses;

    }

    /*
     * Funções que retornam views
     */
    /*public function show($id) {
        $schools = School::findOrFail($id);
        return $schools;
        return view('school.show', compact('schools'));
    }*/

    public function edit(School $school) {
        return view('school.edit', compact('school'));
    }

    public function create(){
        return view('school.create');
    }

    public function showAll() {

    }

    public function showClasses($id) {
        $gradeClasses = $this->classes($id);
        return view("grade_class.show",compact('gradeClasses'));
    }

}
