<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    protected $guarded =["id"];

    public function answeredTest() {
        return $this->hasMany(AnsweredTest::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public static function allTests(){
        return [DB::table('tests')->value('id')];
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function gradeClass() {
        return $this->belongsTo(GradeClass::class);
    }

}
