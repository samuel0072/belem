<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Subject;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

//por enquanto controler nao vai ser usado
class SubjectController extends Controller
{

    /**
     * Retorna todas as disciplinas
     * @return Subject[]|Collection
     * @throws AuthorizationException
     */
    public function index()
    {
        $subs = Subject::all();
        $this->authorize('viewAny');
        return $subs;
    }

    /**
     * Cria uma disciplina
     * @param SubjectRequest $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(SubjectRequest $request)
    {
        $subject = $request->validated();
        $this->authorize('create');

        Subject::create($subject);
        $url = $request->fullUrl();
        return redirect($url);
    }


    /**
     * Retorna a disciplina
     * @param Subject $subject
     * @return Subject
     * @throws AuthorizationException
     */
    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);
        return $subject;
    }


    /**
     * Atualiza a disciplina
     * @param SubjectRequest $request
     * @param Subject $subject
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $this->authorize('update', $subject);
        $subject->update($data);
        $url = $request->fullUrl();
        return redirect($url);
    }

    /**
     * Deleta a disciplina
     * @param Subject $subject
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();
        return redirect('/');
    }

    /**
     * Metodo nao utilizado
     * @return ResponseFactory|Response
     */
    public function create() {
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
