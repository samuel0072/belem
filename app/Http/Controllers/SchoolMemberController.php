<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMemberRequest;
use App\SchoolMember;
use Illuminate\Support\Facades\DB;

class SchoolMemberController extends Controller
{

    /*public function index()
    {
        $students = SchoolMember::all();
        return view('school_member.showAll', compact('students'));
    }*/

    public function store(SchoolMemberRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['grade_class_id'];
        SchoolMember::create($validated);
        return redirect("/grade_class/$id/students");
    }

    public function show($id)
    {
        $student = SchoolMember::findOrFail($id);
        return view('school_member.show', compact('student'));
    }

    public function update(SchoolMemberRequest $request, $id)
    {
        $schoolMember = SchoolMember::findOrFail($id);
        $validated = $request->validated();
        $schoolMember->update($validated);
        return redirect("/grade_class/$schoolMember->grade_class_id/students");
    }

    public function destroy($id)
    {
        $schoolMember = SchoolMember::findOrFail($id);
        $class = $schoolMember->grade_class_id;
        $schoolMember->delete();
        return redirect("/grade_class/$class/students");
    }

    public function edit($id) {
        $schoolMember = SchoolMember::findOrFail($id);
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

    public function getTopicScore($student_id, $test_id, $topic_id) {
        $student = SchoolMember::findOrFail($student_id);
        $score = (new TestController)->topicCount($test_id, $topic_id, $student_id);
        return $score;
    }


    public function getMemberbyEnroll($enroll) {
        $member = DB::table('school_members')
                    ->where('enroll', '=', $enroll) ->get();
        if($user->acess_level > 0) {
            return $member;
        }
        else {
            return [];
        }
    }

}
