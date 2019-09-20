<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function index(){
        if( auth()->user()->access_level > 2) {
            $schools = School::all();
        }
        else {
            $schools = School::where('id', auth()->user()->school_id)->get();
        }
        return view('school.show' , compact('schools'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        School::create($validated);
        return redirect("/school");

    }

    public function update(Request $request, School $school){

        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        $school->update($validated);
        return redirect("/school");
    }

    public function destroy(School $school){
        $school->delete();
        return redirect("/school");
    }

    public function classes($id) {
        $school = School::findOrFail($id);
        $gradeClasses = $school->gradeClasses;

        return $gradeClasses;

    }

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
        return view("grade_class.show",compact(['gradeClasses', 'id']));
    }

}
