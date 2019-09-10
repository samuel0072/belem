<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Test;

class TestController extends Controller
{

    public function index()
    {
        $test = Test::all();
        return $test;
    }



    public function store(TestRequest $request)
    {
        $validated = $request->validated();
        return Test::create($validated);
    }


    public function show(Test $test)
    {
        return $test;
    }


    public function update(TestRequest $request, Test $test)
    {
        $validated = $request->validated();
        $test->update($validated);
        return $test;
    }


    public function destroy(Test $test)
    {
        $test->update();
    }
}
