<?php

namespace App\Policies;

use App\User;
use App\GradeClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class GradeClassPolicy
{
    use HandlesAuthorization;

    /**
     * Se for admin, pode fazer tudo
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->acess_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any grade classes.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->access_level > 2;
    }

    /**
     * Determine whether the user can view the grade class.
     *
     * @param User $user
     * @param GradeClass $gradeClass
     * @return mixed
     */
    public function view(User $user, GradeClass $gradeClass)
    {
        if($user->access_level > 1 && $user->school_id == $gradeClass->school_id){
            return true;
        }
        else if($user->access_level > 0 && $user->school_id == $gradeClass->school_id){
            $classes = $user->classes();
            foreach ($classes as $class){
                if($class->id == $gradeClass->id){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create grade classes.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->access_level > 1;
    }

    /**
     * Determine whether the user can update the grade class.
     *
     * @param User $user
     * @param GradeClass $gradeClass
     * @return bool
     */
    public function update(User $user, GradeClass $gradeClass)
    {

        return $this->view($user, $gradeClass);
    }

    /**
     * Determine whether the user can delete the grade class.
     *
     * @param User $user
     * @param GradeClass $gradeClass
     * @return bool
     */
    public function delete(User $user, GradeClass $gradeClass)
    {
        return ($user->school_id == $gradeClass->school_id) && ($user->access_level > 1);
    }

    /**
     * Determine whether the user can restore the grade class.
     *
     * @param User $user
     * @param GradeClass $gradeClass
     * @return bool
     */
    public function restore(User $user, GradeClass $gradeClass)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the grade class.
     *
     * @param User $user
     * @param GradeClass $gradeClass
     * @return bool
     */
    public function forceDelete(User $user, GradeClass $gradeClass)
    {
        return false;
    }
}
