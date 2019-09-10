<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        $test = Test::all();
        return $test;
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(Test $test)
    {

    }


    public function edit(Test $test)
    {

    }


    public function update(Request $request, Test $test)
    {

    }


    public function destroy(Test $test)
    {

    }
}
