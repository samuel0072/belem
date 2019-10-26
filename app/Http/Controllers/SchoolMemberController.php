<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\Http\Requests\SchoolMemberRequest;
use App\SchoolMember;
use App\UserGradeClass;
use Illuminate\Support\Facades\DB;

class SchoolMemberController extends Controller
{

    public function index()
    {
       return redirect('/', 403);
    }

    public function store(SchoolMemberRequest $request)
    {
        $this->authorize('create', SchoolMember::class);
        $validated = $request->validated();
        $id = $validated['grade_class_id'];
        SchoolMember::create($validated);
        return redirect("/grade_class/$id/students");
    }

    public function show($id)
    {

        $student = SchoolMember::findOrFail($id);
        $this->authorize('view', $student);
        return view('school_member.show', compact('student'));
    }

    public function update(SchoolMemberRequest $request, $id)
    {

        $schoolMember = SchoolMember::findOrFail($id);
        $this->authorize('update', $schoolMember);
        $validated = $request->validated();
        $schoolMember->update($validated);
        return redirect("/grade_class/$schoolMember->grade_class_id/students");
    }

    public function destroy($id)
    {
        $schoolMember = SchoolMember::findOrFail($id);

        $this->authorize('delete', $schoolMember);
        $class = $schoolMember->grade_class_id;
        $schoolMember->delete();
        return redirect("/grade_class/$class/students");
    }

    public function edit($id) {
        $schoolMember = SchoolMember::findOrFail($id);
        $this->authorize('update', $schoolMember);
        return view("school_member.edit", compact('schoolMember'));
    }

    public function create() {
        $this->authorize('create');
        return view("school_member.create");
    }

    public function answeredTests($id) {
        $student = SchoolMember::findOrFail($id);
        $this->authorize('viewAnsTests', $student);
        return $student->answeredTests;
    }

    public function showAnsweredTests($id) {
        $answeredTests = $this->answeredTests($id);
        $student = $this->show(SchoolMember::findOrFail($id));
        $this->authorize('view', $student);

        return view('ans_test.showAll', compact(['answeredTests', 'student']));
    }

    public function getTopicScore($student_id, $test_id, $topic_id) {
        $student = SchoolMember::findOrFail($student_id);
        $this->authorize('viewTopicScore', $student);
        $score = (new TestController)->topicCount($test_id, $topic_id, $student_id);
        return $score;
    }


    public function getMemberbyEnroll($enroll) {
        $member = SchoolMember::where('enroll', $enroll) ->get();
        $this->authorize('view', $member);
        return $member;
    }

}
