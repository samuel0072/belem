<?php

namespace App\Http\Controllers;

use api\School\GradeClass;
use App\Http\Requests\TestRequest;
use App\Question;
use App\SchoolMember;
use App\Test;
use App\Topic;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function Sodium\compare;

class TestController extends Controller
{

    /**
     * Metodo não utilizado.
     * @return RedirectResponse|Redirector
     */
    public function index()
    {

        return redirect('/', 403);
    }

    /**
     * Cria um test no banco
     * @param TestRequest $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(TestRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        $id = $validated['grade_class_id'];
        Test::create($validated);
        return redirect("/grade_class/$id/tests");
    }

    /**
     * Renderiza uma view para mostrar o test
     * @param Test $test
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Test $test)
    {
        $this->authorize('view', $test);
        return view('test.show', compact('test'));
    }


    /**
     * Atualiza os dados do test especificado
     * @param TestRequest $request
     * @param Test $test
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(TestRequest $request, Test $test)
    {
        $this->authorize('update', $test);
        $validated = $request->validated();
        $id = $test->grade_class_id;
        $test->update($validated);
        return redirect("/grade_class/$id/tests");
    }

    /**
     * Deleta o test especificado
     * @param Test $test
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(Test $test)
    {
        $this->authorize('delete', $test);
        $id = $test->grade_class_id;
        $test->delete();
        return redirect("/grade_class/$id/tests");
    }


    /**
     * Retorna as respostas dos alunos ao test
     * @param int $id
     * @return AnsweredTest[]
     * @throws AuthorizationException
     */
    public function answers($id) {

        $test = Test::findOrFail($id);
        $this->authorize('view', $test);
        return $test->answeredTest;
    }

    /**
     * Retorna os estudantes que responderam o test
     * @param int $id
     * @return SchoolMember[]
     * @throws AuthorizationException
     */
    public function students($id) {
        $ans_tests = $this->answers($id);
        $students = [];
        foreach ($ans_tests as $ans_test) {
            $student = SchoolMember::findOrFail($ans_test->school_member_id);
            $students[] = $student;
        }
        return $students;
    }

    /**
     * Corrige os AnsweredTest dos alunos
     * @param int $testId
     * @throws AuthorizationException
     * @return void
     */
    public function correctAnsTests($testId) {
        $test = Test::findOrFail($testId);
        $this->authorize('update', $test);
        $answeredTests = $test->answeredTest;
        foreach($answeredTests as $answeredTest) {
            // se ja nao tiver corrigido
            if(!$answeredTest->done) {
                //vai corrigir uma a uma as questoes
                $questionAnswereds = $answeredTest->questionAnsweredTests;

                foreach ($questionAnswereds as $questionAnswered) {
                    $question = Question::findOrFail($questionAnswered->question_id);

                    if($question->correct_answer == $questionAnswered->option_choosed) {
                        $answeredTest->score++;//Aumenta o score
                    }
                }
                //AnsweredTest corrigido e atualizado
                $answeredTest->done = true;
                $answeredTest->update();
            }
        }
    }


    /**
     * Retorna a proporcao de questoes de cada topico acertadas pelos alunos
     * Exemplo: Em um test tinham 5 questoes do descritor d1, 5 alunos fizeram a prova. Entao, tinham
     * 5 * 5 questoes para corrigir do descritor d1. Entao, após a correcao, 18 foram acertadas. O retorno vai ser 18/25.
     * Retorna 0 quando o test nao tem questoes do descritor.
     * @param int $test_id
     * @param int $topic_id
     * @param int $student_id
     * @return float|int
     * @throws AuthorizationException
     */
    public function topicCount($test_id, $topic_id, $student_id = 0) {
        $count = 0;

        $topic = Topic::findOrFail($topic_id);
        $test = Test::findOrFail($test_id);
        $this->authorize('view', $test);
        $student = SchoolMember::find($student_id);
        $ans_tests = $test->answeredTest;
        $topicQuestions = [];//pra facilitar a busca das questoes do topic

        //essa parte e pra o relatorio individual de cada aluno
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

    /**
     * Retorna o score dos alunos
     * Agrupa pelo score
     * @param int $test_id
     * @return Collection
     * @throws AuthorizationException
     */

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

    /**
     * Redireciona para a view de atualizacao o test especificado
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function edit($id){
        $test = Test::findOrFail($id);
        $this->authorize('update', $test);
        return redirect("/grade_class/$test->grade_class_id/tests", compact('id'));
    }

    /**
     * Renderiza uma view para mostrar os estudantes que fizeram o test
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function showStudents($id) {
        $students = $this->students($id);
        return view("school_member.showAll", compact(['students', 'id']));
    }

    /**
     * Renderiza uma view para mostrar os answeredTest dos estudantes
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function showAnswers($id) {
        $answeredTests = $this->answers($id);
        return view('ans_test.showAll', compact(['answeredTests', 'id']));
    }

    /**
     * Retorna as questoes do test
     * @param int $test_id
     * @return Question[]
     * @throws AuthorizationException
     */
    public function questions($test_id) {
        $test = Test::findOrFail($test_id);
        $this->authorize('view', $test);
        return $test->questions;
    }

}
