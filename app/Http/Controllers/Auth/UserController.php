<?php


namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function showUsers($school_id){
        $user= auth()->user();
        $users = [];
        if($user->access_level > 2) {
            $users = User::all();
        }
        else if($user->access_level > 1){
            $users = $user->showUsers($school_id);
        }
        return view("auth.usersShow", compact('users'));
    }

    public function setAccLevel(UserRequest $request, $school_id){
        $validated = $request->validated();
        $model = User::findOrFail($validated['id']);
        $this->authorize('allowUpdateAccessLevel', $model);

        $model->access_level = $validated['access_level'];
        $model->update();

        return redirect("school/$school_id/users");
    }
}
