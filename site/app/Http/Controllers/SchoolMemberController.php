<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMemberRequest;
use App\SchoolMember;

class SchoolMemberController extends Controller
{

    public function index()
    {
        $students = SchoolMember::all();
        return view('school_member.showAll', compact('students'));
    }

    public function store(SchoolMemberRequest $request)
    {
        $validated = $request->validated();
        return SchoolMember::create($validated);
    }

    public function show($id)
    {
        $student = SchoolMember::findOrFail($id);
        return view('school_member.show', compact('student'));
    }

    public function update(SchoolMemberRequest $request, SchoolMember $schoolMember)
    {
        $validated = $request->validated();
        $schoolMember->update($validated);
        return $schoolMember;
    }

    public function destroy(SchoolMember $schoolMember)
    {
        $schoolMember->delete();
        return $this->index();
    }

    public function edit(SchoolMember $schoolMember) {
        return view("school_member.edit", compact('schoolMember'));
    }

    public function create() {
        return view("school_member.create");
    }

    public function answeredTests($id) {
        $student = SchoolMember::findOrFail($id);
        return $student->answeredTests;
    }

    public function showAnsweredTests($id) {
        $answeredTests = $this->answeredTests($id);
        $student = $this->show(SchoolMember::findOrFail($id));

        return view('ans_test.showAll', compact(['answeredTests', 'student']));
    }

}
