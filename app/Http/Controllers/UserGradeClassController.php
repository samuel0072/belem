<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserGradeClassRequest;
use App\UserGradeClass;
use Illuminate\Http\Request;

class UserGradeClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response('not allowed', 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response('not allowed', 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGradeClassRequest $request)
    {
        $this->authorize('create');
        $data = $request->validated();
        UserGradeClass::create($data);
        return redirect('/', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserGradeClass  $userGradeClass
     * @return \Illuminate\Http\Response
     */
    public function show(UserGradeClass $userGradeClass)
    {
        $this->authorize('view', $userGradeClass);
        return $userGradeClass;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserGradeClass  $userGradeClass
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGradeClass $userGradeClass)
    {
        return redirect('/', 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserGradeClass  $userGradeClass
     * @return \Illuminate\Http\Response
     */
    public function update(UserGradeClassRequest $request, UserGradeClass $userGradeClass)
    {
        $this->authorize('update', $userGradeClass);
        $data = $request->validated();
        $userGradeClass->update($data);
        return $userGradeClass;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserGradeClass  $userGradeClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGradeClass $userGradeClass)
    {
        $this->authorize('delete', $userGradeClass);
        $userGradeClass->delete();
        return redirect('/', 200);
    }
}
