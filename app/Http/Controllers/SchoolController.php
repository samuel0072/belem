<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        $this->authorize('create', School::class);

        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        School::create($validated);
        return redirect("/school");
    }

    public function update(Request $request, School $school){
        $this->authorize('update', $school);

        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        $school->update($validated);
        return redirect("/school");
    }

    public function destroy(School $school){
        $this->authorize('delete', $school);
        $school->delete();
        return redirect("/school");
    }

    public function classes($id) {
        $user = auth()->user();
        $school = School::findOrFail($id);
        $this->authorize('allowShowClasses', $school);
        $gradeClasses = [];
        if($user->access_level > 1) {
            $gradeClasses = $school->gradeClasses;
        }
        else {
            $gradeClasses = $user->classes();
        }
        return $gradeClasses;
    }

    public function edit(School $school) {
        $this->authorize('update', $school);
        return view('school.edit', compact('school'));
    }

    public function create(){
        $this->authorize('create', School::class);
        return view('school.create');
    }

    public function showClasses($id) {
        $gradeClasses = $this->classes($id);
        return view("grade_class.show",compact(['gradeClasses', 'id']));
    }

}
