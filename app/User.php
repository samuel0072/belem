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

    public function clazzes() {
        $classes = [];
        $class_asoc =  $this->hasMany(UserGradeClass::class);

        foreach ($class_asoc as $cl) {
            $class = $cl->clazz;
            $classes[] = $class;
        }
       return $classes;
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
