<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeClass extends Model
{
    protected $guarded =["id"];

    public function school() {
        return $this->belongsTo(School::class);
    }
    public function schoolMembers() {
        return $this->hasMany(SchoolMember::class);
    }
    public function tests() {
        return $this->hasMany(Test::class);
    }
}
