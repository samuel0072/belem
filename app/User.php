<?php

namespace App;

use App\Policies\SchoolPolicy;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Retorna todos os usuarios de uma escola
     * @param iny $school_id
     * @return Collection
     */
    public static function showUsers( $school_id, $user_id){
        return DB::table('users')->where([
            ['school_id', $school_id],
            ['id', '<>', $user_id]
        ])->get();
    }

    /**
     * Retorna todas as classes associadas ao usuario
     * @return Collection
     */
    public function classes() {
        $id = $this->id;
        return DB::table('grade_classes')
                ->join('user_grade_classes', function($join) use ($id) {
                    $join->on('grade_class_id', '=', 'grade_classes.id')
                            ->where('user_id', '=', $id);
                    })
                ->get();
    }

    /**
     * Retorna a escola associada
     * @return BelongsTo
     */
    public function school() {
        return $this->belongsTo(School::class);
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
