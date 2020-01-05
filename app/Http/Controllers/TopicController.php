<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Topic;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny');
        $topics = DB::table('topics')->select('id', 'name')->get();
        return $topics;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(TopicRequest $request)
    {
        $topic = $request->validated();
        $this->authorize('create');
        Topic::create($topic);
        $url = $request->fullUrl();
        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @return Topic
     * @throws AuthorizationException
     */
    public function show(Topic $topic)
    {
        $this->authorize('view');
        return $topic;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TopicRequest $request
     * @param Topic $topic
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $data = $request->validated();
        $this->authorize('update', $topic);
        $topic->update($data);
        $url = $request->fullUrl();
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Topic $topic
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete');
        $topic->delete();
        return redirect('/');
    }
}
