<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\School;
use Illuminate\Http\Request;

class GradeClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param School $school
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = request("id");
        return view("grade_class.create", compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(School $school, Request $request)
    {
        request()->validate([
                "letter" => ["required", "max:1"],
                "number" => ["required"]
            ]);
        $grade_class = new GradeClass();
        $validate = validate(request());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GradeClass  $gradeClass
     * @return \Illuminate\Http\Response
     */
    public function show(GradeClass $gradeClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GradeClass  $gradeClass
     * @return \Illuminate\Http\Response
     */
    public function edit(GradeClass $gradeClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GradeClass  $gradeClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradeClass $gradeClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GradeClass  $gradeClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeClass $gradeClass)
    {
        //
    }
}
