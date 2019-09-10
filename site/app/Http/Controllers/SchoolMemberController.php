<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMemberRequest;
use App\SchoolMember;

class SchoolMemberController extends Controller
{

    public function index()
    {
        $member = SchoolMember::all();
        return $member;
    }

    public function store(SchoolMemberRequest $request)
    {
        $validated = $request->validated();
        return SchoolMember::create($validated);
    }

    public function show(SchoolMember $schoolMember)
    {
        return $schoolMember;
    }

    public function update(SchoolMemberRequest $request, SchoolMember $schoolMember)
    {
        $validated = $request->validated();
        $schoolMember->update($validated);
        return $schoolMember;
    }

    public function destroy(SchoolMember $schoolMember)
    {
        $schoolMember->delete();
        return $this->index();
    }

    /*public function edit(SchoolMember $schoolMember) {
        return view("test.edit", compact('schoolMember'));
    }

    public function create() {
        return view("test.create");
    }*/

}
