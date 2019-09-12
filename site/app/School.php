<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = ["id"];

    public function gradeClasses() {
        return $this->hasMany(GradeClass::class);
    }
}
