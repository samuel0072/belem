<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolMember extends Model
{
    //
    protected $guarded = ["id"];

    public function answeredTests() {
        return $this->hasMany(AnsweredTest::class);
    }

    public function grade_class(){
        return $this->belongsTo(GradeClass::class);
    }
}
