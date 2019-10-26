<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
//por enquanto controler nao vai ser usado
class SubjectController extends Controller
{

    public function index()
    {
        $subs = Subject::all();
        $this->authorize('viewAny');
        return $subs;
    }

    public function store(SubjectRequest $request)
    {
        $subject = $request->validated();
        $this->authorize('create');

        Subject::create($subject);
        $url = $request->fullUrl();
        return redirect($url);
    }


    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);
    }


    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $this->authorize('update', $subject);
        $subject->update($data);
        $url = $request->fullUrl();
        return redirect($url);
    }
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();
        return redirect('/');
    }
}
