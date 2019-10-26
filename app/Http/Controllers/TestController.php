<?php

namespace App\Http\Controllers;

use api\School\GradeClass;
use App\Http\Requests\TestRequest;
use App\Question;
use App\SchoolMember;
use App\Test;
use App\Topic;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class TestController extends Controller
{

    public function index()
    {

        return redirect('/', 403);
    }

    public function store(TestRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        $id = $validated['grade_class_id'];
        Test::create($validated);
        return redirect("/grade_class/$id/tests");
    }

    public function show(Test $test)
    {
        $this->authorize('view', $test);
        return view('test.show', compact('test'));
    }


    public function update(TestRequest $request, Test $test)
    {
        $this->authorize('update', $test);
        $validated = $request->validated();
        $id = $test->grade_class_id;
        $test->update($validated);
        return redirect("/grade_class/$id/tests");
    }

    public function destroy(Test $test)
    {
        $this->authorize('delete', $test);
        $id = $test->grade_class_id;
        $test->delete();
        return redirect("/grade_class/$id/tests");
    }

    public function answers($id) {

        $test = Test::findOrFail($id);
        $this->authorize('view', $test);
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
        $this->authorize('update', $test);
        $answeredTests = $test->answeredTest;
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


    public function topicCount($test_id, $topic_id, $student_id = 0) {
        $count = 0;

        $topic = Topic::findOrFail($topic_id);
        $test = Test::findOrFail($test_id);
        $this->authorize('view', $test);
        $student = SchoolMember::find($student_id);
        $ans_tests = $test->answeredTest;
        $topicQuestions = [];

        if($student != null) {
            $ans_tests = $student->answeredTests;
        }

        $total = count($topic->questions) * count($ans_tests);

        if($total > 0) {
            foreach ($topic->questions as $question) {
                if($question->test_id == $test_id) {
                    $topicQuestions[$question->id] = $question->correct_answer;
                }
            }

            foreach ($ans_tests as $ans_test) {
                $qsts_ans = $ans_test->questionAnsweredTests;

                foreach ($qsts_ans as $qst_ans) {
                    if(array_key_exists($qst_ans->question_id, $topicQuestions)) {
                        if($topicQuestions[$qst_ans->question_id] == $qst_ans->option_choosed) {
                            $count++;
                        }
                    }
                }
            }
            return ($count/$total) * 100;
        }
        else {
            return 0;
        }
    }

    public function scoreCount($test_id) {
        $test = Test::findOrFail($test_id);
        $this->authorize('view', $test);
        $result = DB::table('answered_tests')
                    ->selectRaw('COUNT(score) as count, score as name')
                    ->where('test_id', '=', $test_id)
                    ->groupBy('score')
                    ->get();
        return $result;
    }



    public function edit($id){
        $test = Test::findOrFail($id);
        $this->authorize('update', $test);
        return redirect("/grade_class/$test->grade_class_id/tests", compact('id'));
    }

    public function showStudents($id) {
        $students = $this->students($id);
        return view("school_member.showAll", compact(['students', 'id']));
    }

    public function showAnswers($id) {
        $answeredTests = $this->answers($id);
        return view('ans_test.showAll', compact(['answeredTests', 'id']));
    }

    public function questions($test_id) {
        $test = Test::findOrFail($test_id);
        $this->authorize('view', $test);
        return $test->questions;
    }




}
