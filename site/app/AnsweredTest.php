<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsweredTest extends Model
{
    protected $guarded = ["id"];

    public function questionAnsweredTests() {
        return $this->hasMany(QuestionAnsweredTest::class);
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }
    /*
     * Nao funciona O.O
     * */
    public function student() {
        return $this->belongsTo(SchoolMember::class);
    }

}
