<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function index()
    {
        $school = School::all();
        return $school;
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"]
        ]);
        School::create($validated);
        return $validated;
    }


    public function show(School $school)
    {
        return $school;
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            "name" => ["required", "min:2", "max:255"]
        ]);
        $school->update(\request("name"));
        return redirect("/school/$school->id");
    }

    public function destroy(School $school)
    {
        //
        $school->delete();
        return redirect("/school");
    }
}
