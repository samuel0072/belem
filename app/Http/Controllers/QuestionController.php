<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Test;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuestionController extends Controller
{

    /**
     * Cria uma Question
     * @param QuestionRequest $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(QuestionRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        Question::create($validated);
        $id = $validated["test_id"];
        return redirect("/test/$id");
    }


    /**
     * Renderiza uma view para mostar a questao
     * @param Question $question
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Question $question)
    {
        $this->authorize('view', $question);
        return view('question.edit', compact('question'));
    }

    /**
     * Atualiza a questao
     * @param QuestionRequest $request
     * @param Question $question
     * @return Question
     * @throws AuthorizationException
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);
        $validated = $request->validated();
        $question->update($validated);
        return $question;
    }

    /**
     * Deleta a questao
     * @param Question $question
     * @throws AuthorizationException
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
    }

    /**
     * Retorna a quantidade de escolhas de cada opcao escolhida da questao
     * @param int $id
     * @return Collection
     * @throws AuthorizationException
     */
    public function optionCount($id) {
        $question = Question::findOrFail($id);
        $this->authorize('view', $question);

        $results = DB::table('question_answered_tests')
            ->selectRaw("option_choosed, COUNT(answered_test_id) as quantity")//todo:graficos aqui
            ->whereRaw("question_id = ?", [$question->id])
            ->groupBy("option_choosed")
            ->get();
        return $results;
    }

    /**
     * Metodo nao utilizado
     * @return ResponseFactory|Response
     */
    public function index()
    {
        return response('not allowed', 403);
    }

    /**
     * Metodo nao utilizado
     * @return ResponseFactory|Response
     */
    public function create(){
        return response('not allowed', 403);
    }

    /**
     * Metodo nao utilizado
     * @return ResponseFactory|Response
     */
    public function edit(){
       return response('not allowed', 403);
    }
}
