<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny');
        $topics = DB::table('topics')->select('id', 'name')->get();
        return $topics;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @param  \App\Topic  $topic
     * @return \App\Topic
     */
    public function show(Topic $topic)
    {
        $this->authorize('view');
        return $topic;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
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
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete');
        $topic->delete();
        return redirect('/');
    }
}
