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
        $validated = $request->validate();
        SchoolMember::create($validated);
        return $validated;
    }


    public function show(SchoolMember $schoolMember)
    {
        return $schoolMember;
    }

    public function update(SchoolMemberRequest $request, SchoolMember $schoolMember)
    {
        $request->validate();
        $validated = $request->validated();
        $schoolMember->update($request->input());
        return $schoolMember;

    }

    public function destroy(SchoolMember $schoolMember)
    {
        $schoolMember->delete();
        return $this->index();
    }


}
