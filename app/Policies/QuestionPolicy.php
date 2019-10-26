<?php

namespace App\Policies;

use App\User;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->access_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any questions.
     *
     * @param  \App\User  $user
     * @return mixed
     */

    public function viewAny(User $user)
    {
        return $user->access_level > 2;
    }

    /**
     * Determine whether the user can view the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function view(User $user, Question $question)
    {
        $class = $question->test->gradeClass;
        $school_id = $class->school_id;
        if($user->access_level > 1 && $user->school_id == $school_id){
            return true;
        }
        else if($user->access_level > 0 && $user->school_id == $class->school_id){
            $classes = $user->classes();
            foreach ($classes as $class){
                if($class->id == $class->id){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create questions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_level > 0;
    }

    /**
     * Determine whether the user can update the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function update(User $user, Question $question)
    {
        return $this->view($user, $question);
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function delete(User $user, Question $question)
    {
        return $this->view($user, $question);
    }

    /**
     * Determine whether the user can restore the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function restore(User $user, Question $question)
    {
        return $this->view($user, $question);
    }

    /**
     * Determine whether the user can permanently delete the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function forceDelete(User $user, Question $question)
    {
        return $this->view($user, $question);
    }
}
