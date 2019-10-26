<?php

namespace App\Providers;

use App\AnsweredTest;
use App\GradeClass;
use App\Policies\AnsweredTestPolicy;
use App\Policies\GradeClassPolicy;
use App\Policies\QuestionAnsweredTestPolicy;
use App\Policies\SchoolPolicy;
use App\Policies\SubjectPolicy;
use App\Policies\TestPolicy;
use App\Policies\UserPolicy;
use App\QuestionAnsweredTest;
use App\School;
use App\Subject;
use App\Test;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        School::class => SchoolPolicy::class,
        User::class => UserPolicy::class,
        GradeClass::class => GradeClassPolicy::class,
        AnsweredTest::class => AnsweredTestPolicy::class,
        Subject::class => SubjectPolicy::class,
        QuestionAnsweredTest::class => QuestionAnsweredTestPolicy::class,
        Test::class => TestPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            if($user->access_level > 2) {
                return true;
            }
        });

        Gate::define('create-school', function($user) {
           return $user->access_level > 2;
        });
        Gate::define('update-school', function($user, $school) {
            return (($user->access_level > 1) && ($user->school_id == $school->id));
        });
        Gate::define('destroy-school', function($user, $school) {
            return $user->access_level > 2;
        });
    }
}
