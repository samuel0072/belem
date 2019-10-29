<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Test;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function store(QuestionRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        Question::create($validated);
        $id = $validated["test_id"];
        return redirect("/test/$id");
    }


    public function show(Question $question)
    {
        $this->authorize('view', $question);
        return view('question.edit', compact('question'));
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);
        $validated = $request->validated();
        $question->update($validated);
        return $question;
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
    }

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

    public function index()
    {
        return response('not allowed', 403);
    }

    public function create(){
        return response('not allowed', 403);
   }

   public function edit(){
       return response('not allowed', 403);
   }
}
