<?php

namespace App\Policies;

use App\GradeClass;
use App\User;
use App\SchoolMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolMemberPolicy
{
    use HandlesAuthorization;



    public function before($user, $ability)
    {
        if ($user->acess_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any school members.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->acess_level > 2) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the school member.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolMember  $schoolMember
     * @return mixed
     */
    public function view(User $user, SchoolMember $schoolMember)
    {
        //tem de estar na mesma escola e mesma classe e o usuario ser no minimo professor
        $classes = $user->classes();
        $sc_class = $schoolMember->grade_class;
        $school_id = $sc_class->school_id;

        if(($user->access_level > 0)  && ($school_id == $user->school_id)) {
            if($user->access_level > 1) {
                return true;
            }

            foreach($classes as $class) {
                if($class->id == $sc_class->id){
                    return true;
                }
            }
        }
        return false;


    }

    /**
     * Determine whether the user can create school members.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_level > 0;
    }

    /**
     * Determine whether the user can update the school member.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolMember  $schoolMember
     * @return mixed
     */
    public function update(User $user, SchoolMember $schoolMember)
    {
        return view($user, $schoolMember);//mesma logica
    }

    /**
     * Determine whether the user can delete the school member.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolMember  $schoolMember
     * @return mixed
     */
    public function delete(User $user, SchoolMember $schoolMember)
    {
        return view($user, $schoolMember);
    }

    /**
     * Determine whether the user can restore the school member.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolMember  $schoolMember
     * @return mixed
     */
    public function restore(User $user, SchoolMember $schoolMember)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the school member.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolMember  $schoolMember
     * @return mixed
     */
    public function forceDelete(User $user, SchoolMember $schoolMember)
    {
        return false;
    }

    public function viewAnsTests(User $user, SchoolMember $schoolMember){
        return view($user, $schoolMember);
    }

    public function viewTopicScore(User $user, SchoolMember $schoolMember){
        return view($user, $schoolMember);
    }
}
