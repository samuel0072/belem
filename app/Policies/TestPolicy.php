<?php

namespace App\Policies;

use App\User;
use App\Test;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if($user->access_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any tests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the test.
     *
     * @param  \App\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function view(User $user, Test $test)
    {
        if($user->access_level > 1 && $test->gradeClass()->school_id == $user->school_id){
            return true;
        }
        else{

            foreach ($user->classes() as $class){
                if($class->id == $test->gradeClass()->id){
                    return true;
                }
            }
        }

    }

    /**
     * Determine whether the user can create tests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_level > 0;
    }

    /**
     * Determine whether the user can update the test.
     *
     * @param  \App\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function update(User $user, Test $test)
    {
        return $this->view($user, $test);
    }

    /**
     * Determine whether the user can delete the test.
     *
     * @param  \App\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function delete(User $user, Test $test)
    {
        return $this->view($user, $test);
    }

    /**
     * Determine whether the user can restore the test.
     *
     * @param  \App\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function restore(User $user, Test $test)
    {
        return $this->view($user, $test);
    }

    /**
     * Determine whether the user can permanently delete the test.
     *
     * @param  \App\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function forceDelete(User $user, Test $test)
    {
        return $this->view($user, $test);
    }
}
