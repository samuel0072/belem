<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnsweredTest extends Model
{
    protected $guarded =["id"];

    public function ansTest() {
        return $this->belongsTo(AnsweredTest::class);
    }

    public function test(){
        return $this->ansTest->test;
    }
}
