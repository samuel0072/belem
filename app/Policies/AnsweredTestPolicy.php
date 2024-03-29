<?php

namespace App\Policies;

use App\GradeClass;
use App\User;
use App\AnsweredTest;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnsweredTestPolicy
{
    use HandlesAuthorization;

    /**
     * Se for admin, pode fazer tudo
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->acess_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any answered tests.
     *
     * @param User $user
     * @return null
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the answered test.
     *
     * @param User $user
     * @param AnsweredTest $answeredTest
     * @return bool
     */
    public function view(User $user, AnsweredTest $answeredTest)
    {
        $gr = GradeClass::find($answeredTest->grade_class_id);
        if($user->access_level > 1 && $gr->school_id == $user->school_id){
            return true;
        }
        else{

            foreach ($user->classes() as $class){
                if($class->id == $gr->id){
                    return true;
                }
            }
        }
    }

    /**
     * Determine whether the user can create answered tests.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->access_level > 0;
    }

    /**
     * Determine whether the user can update the answered test.
     *
     * @param User $user
     * @param AnsweredTest $answeredTest
     * @return bool
     */
    public function update(User $user, AnsweredTest $answeredTest)
    {
        return $this->view($user, $answeredTest);
    }

    /**
     * Determine whether the user can delete the answered test.
     *
     * @param User $user
     * @param AnsweredTest $answeredTest
     * @return mixed
     */
    public function delete(User $user, AnsweredTest $answeredTest)
    {
        return $this->view($user, $answeredTest);
    }

    /**
     * Determine whether the user can restore the answered test.
     *
     * @param User $user
     * @param AnsweredTest $answeredTest
     * @return bool
     */
    public function restore(User $user, AnsweredTest $answeredTest)
    {
        return $this->view($user, $answeredTest);
    }

    /**
     * Determine whether the user can permanently delete the answered test.
     *
     * @param User $user
     * @param AnsweredTest $answeredTest
     * @return bool
     */
    public function forceDelete(User $user, AnsweredTest $answeredTest)
    {
        return $this->view($user, $answeredTest);
    }
}
