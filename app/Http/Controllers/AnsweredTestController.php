<?php

namespace App\Http\Controllers;

use App\AnsweredTest;
use App\Http\Requests\AnsTestRequest;
use App\SchoolMember;
use App\Test;

class AnsweredTestController extends Controller
{
    public function index()
    {

        return redirect('/', 403);
    }

    public function store(AnsTestRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        $id = $validated["school_member_id"];
        $answered = AnsweredTest::create($validated);
        return redirect("/schoolmember/$id");
    }

    public function show(AnsweredTest $answeredTest)
    {
        $this->authorize('view', $answeredTest);
        return view('ans_test.show', compact('answeredTest'));
    }

    public function update(AnsTestRequest $request, AnsweredTest $answeredTest)
    {
        $this->authorize('update', $answeredTest);
        $validated = $request->validated();
        $answeredTest->update($validated);
        return $answeredTest;
    }

    public function destroy(AnsweredTest $answeredTest)
    {
        $this->authorize('delete', $answeredTest);
        $answeredTest->delete();
        return $this->index();
    }

    public function edit(AnsweredTest $answeredTest)
    {
        $this->authorize('update', $answeredTest);
        return view("ans_test.edit", compact('answeredTest'));
    }

    public function create()
    {
        return redirect('/', 403);
    }

    public function getStudent($answered_test_id)
    {
        $answeredTest = AnsweredTest::findOrFail($answered_test_id);
        $this->authorize('view', $answeredTest);

        $student = SchoolMember::findOrFail($answeredTest->school_member_id);
        return $student;
    }

    public function getTest($answered_test_id)
    {
        $answeredTest = AnsweredTest::findOrFail($answered_test_id);
        $this->authorize('view', $answeredTest);

        $test = Test::findOrFail($answeredTest->school_member_id);
        return $test;
    }
}
