<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    public function showUsers($user_id, $school_id){
        return DB::table('users')->where([
            ['school_id', $school_id],
            ['id', '<>', $user_id]
        ])->get();
    }

    public function classes() {
        $string = "$this->id";
        return DB::table('grade_classes')
                ->join('user_grade_classes', [
                    ['user_id', '=', $string],
                    ['grade_class_id', '=', 'grade_classes.id']
                ])
                ->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','school_id', 'access_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
