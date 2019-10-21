<?php

namespace App\Policies;

use App\User;
use App\GradeClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class GradeClassPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->acess_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any grade classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the grade class.
     *
     * @param  \App\User  $user
     * @param  \App\GradeClass  $gradeClass
     * @return mixed
     */
    public function view(User $user, GradeClass $gradeClass)
    {
        if($user->access_level > 1 && $user->school_id == $gradeClass->school_id){
            return true;
        }
        else {
            $classes = $user->classes();
        }
    }

    /**
     * Determine whether the user can create grade classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the grade class.
     *
     * @param  \App\User  $user
     * @param  \App\GradeClass  $gradeClass
     * @return mixed
     */
    public function update(User $user, GradeClass $gradeClass)
    {
        //
    }

    /**
     * Determine whether the user can delete the grade class.
     *
     * @param  \App\User  $user
     * @param  \App\GradeClass  $gradeClass
     * @return mixed
     */
    public function delete(User $user, GradeClass $gradeClass)
    {
        //
    }

    /**
     * Determine whether the user can restore the grade class.
     *
     * @param  \App\User  $user
     * @param  \App\GradeClass  $gradeClass
     * @return mixed
     */
    public function restore(User $user, GradeClass $gradeClass)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the grade class.
     *
     * @param  \App\User  $user
     * @param  \App\GradeClass  $gradeClass
     * @return mixed
     */
    public function forceDelete(User $user, GradeClass $gradeClass)
    {
        //
    }
}
