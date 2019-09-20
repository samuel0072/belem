<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class School extends Model
{
    protected $guarded = ["id"];

    public function gradeClasses() {
        return $this->hasMany(GradeClass::class);
    }

    public static function allSchools() {
        //echo "aff";
        return DB::table('schools')->get();
    }
}
