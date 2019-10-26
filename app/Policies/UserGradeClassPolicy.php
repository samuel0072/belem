<?php

namespace App\Policies;

use App\User;
use App\UserGradeClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGradeClassPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if($user->access_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any user grade classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the user grade class.
     *
     * @param  \App\User  $user
     * @param  \App\UserGradeClass  $userGradeClass
     * @return mixed
     */
    public function view(User $user, UserGradeClass $userGradeClass)
    {
        return $user->id == $userGradeClass->user_id ;
    }

    /**
     * Determine whether the user can create user grade classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_level > 1;
    }

    /**
     * Determine whether the user can update the user grade class.
     *
     * @param  \App\User  $user
     * @param  \App\UserGradeClass  $userGradeClass
     * @return mixed
     */
    public function update(User $user, UserGradeClass $userGradeClass)
    {
        $school = $userGradeClass->clazz->school;
        return ($user->access_level > 1) && ($user->school_id == $school->id);
    }

    /**
     * Determine whether the user can delete the user grade class.
     *
     * @param  \App\User  $user
     * @param  \App\UserGradeClass  $userGradeClass
     * @return mixed
     */
    public function delete(User $user, UserGradeClass $userGradeClass)
    {
        $school = $userGradeClass->clazz->school;
        return ($user->access_level > 1) && ($user->school_id == $school->id);
    }

    /**
     * Determine whether the user can restore the user grade class.
     *
     * @param  \App\User  $user
     * @param  \App\UserGradeClass  $userGradeClass
     * @return mixed
     */
    public function restore(User $user, UserGradeClass $userGradeClass)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the user grade class.
     *
     * @param  \App\User  $user
     * @param  \App\UserGradeClass  $userGradeClass
     * @return mixed
     */
    public function forceDelete(User $user, UserGradeClass $userGradeClass)
    {
        return false;
    }
}
