<?php

namespace App\Http\Controllers;

use api\School\GradeClass;
use App\Http\Requests\TestRequest;
use App\Question;
use App\SchoolMember;
use App\Test;

class TestController extends Controller
{

    public function index()
    {
        $tests = Test::all();
        return $tests;
    }

    public function store(TestRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['grade_class_id'];
        Test::create($validated);
        return redirect("/grade_class/$id/tests");
    }

    public function show(Test $test)
    {
        return view('test.show', compact('test'));
    }


    public function update(TestRequest $request, Test $test)
    {
        $validated = $request->validated();
        $test->update($validated);
        return redirect("/grade_class/$test->id/tests");
    }

    public function destroy(Test $test)
    {
        $id = $test->grade_class_id;
        $test->delete();
        return redirect("/grade_class/$id/tests");
    }

    public function answers($id) {
        $test = Test::findOrFail($id);
        return $test->answeredTest;
    }

    public function students($id) {
        $ans_tests = $this->answers($id);
        $students = [];
        foreach ($ans_tests as $ans_test) {
            $student = SchoolMember::findOrFail($ans_test->school_member_id);
            $students[] = $student;
        }
        return $students;
    }

    public function correctAnsTests($testId) {
        $test = Test::findOrFail($testId);
        $answeredTests = $test->answeredTest;
        if($test->status == "ready") {
            foreach($answeredTests as $answeredTest) {
                if(!$answeredTest->done) {
                    $questionAnswereds = $answeredTest->questionAnsweredTests;

                    foreach ($questionAnswereds as $questionAnswered) {
                        $question = Question::findOrFail($questionAnswered->question_id);

                        if($question->correct_answer == $questionAnswered->option_choosed) {
                            $answeredTest->score++;
                        }
                    }
                    $answeredTest->done = true;
                    $answeredTest->update();
                }
            }
        }
    }

    public function correct() {
        return view("testing.test");
    }

    public function edit($id){
        $test = Test::findOrFail($id);
        return redirect("/grade_class/$test->grade_class_id/tests");
    }

    public function showStudents($id) {
        $students = $this->students($id);
        return view("school_member.showAll", compact('students'));
    }

    public function showAnswers($id) {
        $answeredTests = $this->answers($id);
        return view('ans_test.showAll', compact('answeredTests'));
    }


}
