<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsweredTest extends Model
{
    protected $guarded = ["id"];

    public function questionAnsweredTests() {
        return $this->hasMany(QuestionAnsweredTest::class);
    }

}
