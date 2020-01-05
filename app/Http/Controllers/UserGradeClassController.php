<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserGradeClassRequest;
use App\UserGradeClass;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserGradeClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response('not implemented, neither it will be.', 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response('not implemented, neither it will be.', 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserGradeClassRequest $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     * @throws AuthorizationException
     */
    public function store(UserGradeClassRequest $request)
    {
        $this->authorize('create');
        $data = $request->validated();
        UserGradeClass::create($data);
        return redirect('/' );
    }

    /**
     * Display the specified resource.
     *
     * @param UserGradeClass $userGradeClass
     * @return UserGradeClass
     * @throws AuthorizationException
     */
    public function show(UserGradeClass $userGradeClass)
    {
        $this->authorize('view', $userGradeClass);
        return $userGradeClass;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserGradeClass $userGradeClass
     * @return Response
     */
    public function edit(UserGradeClass $userGradeClass)
    {
        return response('not implemented, neither it will be.', 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserGradeClassRequest $request
     * @param UserGradeClass $userGradeClass
     * @return UserGradeClass
     * @throws AuthorizationException
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
     * @param UserGradeClass $userGradeClass
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     * @throws AuthorizationException
     */
    public function destroy(UserGradeClass $userGradeClass)
    {
        $this->authorize('delete', $userGradeClass);
        $userGradeClass->delete();
        return redirect('/' );
    }
}
