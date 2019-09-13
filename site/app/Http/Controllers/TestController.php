<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Question;
use App\SchoolMember;
use App\Test;

class TestController extends Controller
{

    public function index()
    {
        $tests = Test::all();
        return view('test.showAll', compact('tests'));
    }

    public function store(TestRequest $request)
    {
        $validated = $request->validated();
        return Test::create($validated);
    }

    public function create(){
        return view('test.create');
    }

    public function show(Test $test)
    {
        return view('test.show', compact('test'));
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


    public function showStudents($id) {
        $students = $this->students($id);
        return view("school_member.showAll", compact('students'));
    }

    public function showAnswers($id) {
        $answeredTests = $this->answers($id);
        return view('ans_test.showAll', compact('answeredTests'));
    }


}
