<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded =["id"];

    public function answeredTest() {
        return $this->hasMany(AnsweredTest::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function gradeClass() {
        return $this->belongsTo(GradeClass::class);
    }
}
