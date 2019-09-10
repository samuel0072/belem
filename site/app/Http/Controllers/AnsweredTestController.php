<?php

namespace App\Http\Controllers;

use App\AnsweredTest;
use App\Http\Requests\AnsTestRequest;

class AnsweredTestController extends Controller
{
    public function index()
    {
        $ans_Test = AnsweredTest::all();
        return $ans_Test;
    }

    public function store(AnsTestRequest $request)
    {
        $validated = $request->validated();
        return AnsweredTest::create($validated);
    }

    public function show(AnsweredTest $answeredTest)
    {
        return $answeredTest;
    }

    public function update(AnsTestRequest $request, AnsweredTest $answeredTest)
    {
        $validated = $request->validated();
        $answeredTest->update($validated);
        return $answeredTest;
    }

    public function destroy(AnsweredTest $answeredTest)
    {
        $answeredTest->delete();
        return $this->index();
    }
    /*public function edit(AnsweredTest $answeredTest)
    {
        return view("test.edit", compact('answeredTest'));
    }
    public function create()
    {
        return view("test.create");
    }*/
}
