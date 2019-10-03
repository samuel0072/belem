<?php


namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{


    public function showUsers($id){
        if(auth()->user()->access_level > 2){
            $users = auth()->user()->showUsers(auth()->user()->id, $id);
            return view("auth.usersShow", compact('users'));
        }
    }

    public function setAccLevel(UserRequest $request, $id){
        $validated = $request->validated();
        echo "oi";
        $user = User::findOrFail($id);
        $user->access_level = $validated['access_level'];
        $user->update();
        return redirect("/users/$id");
    }
}
