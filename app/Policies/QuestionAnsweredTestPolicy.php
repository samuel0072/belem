<?php

namespace App\Policies;

use App\User;
use App\GradeClass;
use App\QuestionAnsweredTest;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\App;

class QuestionAnsweredTestPolicy
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
        $gr = GradeClass::find($questionAnsweredTest->grade_class_id);
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
     * Determine whether the user can create question answered tests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_level > 0;
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
        return $this->view($user, $questionAnsweredTest);
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
        return $this->view($user, $questionAnsweredTest);
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
        return $this->view($user, $questionAnsweredTest);
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
        return $this->view($user, $questionAnsweredTest);
    }
}
