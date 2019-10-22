<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnsweredTest extends Model
{
    protected $guarded =["id"];

    public function gradeClass() {
        return $this->belongsTo(Test::class);
    }
}
