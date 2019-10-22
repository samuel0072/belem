<?php

namespace App\Policies;

use App\User;
use App\QuestionAnsweredTest;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionAnsweredTestPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->acess_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any question answered tests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the question answered test.
     *
     * @param  \App\User  $user
     * @param  \App\QuestionAnsweredTest  $questionAnsweredTest
     * @return mixed
     */
    public function view(User $user, QuestionAnsweredTest $questionAnsweredTest)
    {
        if($user->access_level > 1 && $questionAnsweredTest->gradeClass()->school_id == $user->school_id){
            return true;
        }
        else{

            foreach ($user->classes() as $class){
                if($class->id == $questionAnsweredTest->gradeClass()->id){
                    return true;
                }
            }
        }
    }

    /**
     * Determine whether the user can create question answered tests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the question answered test.
     *
     * @param  \App\User  $user
     * @param  \App\QuestionAnsweredTest  $questionAnsweredTest
     * @return mixed
     */
    public function update(User $user, QuestionAnsweredTest $questionAnsweredTest)
    {
        //
    }

    /**
     * Determine whether the user can delete the question answered test.
     *
     * @param  \App\User  $user
     * @param  \App\QuestionAnsweredTest  $questionAnsweredTest
     * @return mixed
     */
    public function delete(User $user, QuestionAnsweredTest $questionAnsweredTest)
    {
        //
    }

    /**
     * Determine whether the user can restore the question answered test.
     *
     * @param  \App\User  $user
     * @param  \App\QuestionAnsweredTest  $questionAnsweredTest
     * @return mixed
     */
    public function restore(User $user, QuestionAnsweredTest $questionAnsweredTest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the question answered test.
     *
     * @param  \App\User  $user
     * @param  \App\QuestionAnsweredTest  $questionAnsweredTest
     * @return mixed
     */
    public function forceDelete(User $user, QuestionAnsweredTest $questionAnsweredTest)
    {
        //
    }
}
