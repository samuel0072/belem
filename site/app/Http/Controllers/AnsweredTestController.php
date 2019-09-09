<?php

namespace App\Http\Controllers;

use App\AnsweredTest;
use Illuminate\Http\Request;

class AnsweredTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ans_Test = AnsweredTest::all();
        return $ans_Test;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnsweredTest  $answeredTest
     * @return \Illuminate\Http\Response
     */
    public function show(AnsweredTest $answeredTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnsweredTest  $answeredTest
     * @return \Illuminate\Http\Response
     */
    public function edit(AnsweredTest $answeredTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnsweredTest  $answeredTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnsweredTest $answeredTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnsweredTest  $answeredTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnsweredTest $answeredTest)
    {
        //
    }
}
