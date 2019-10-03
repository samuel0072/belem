<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ["id"];

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function topic() {
        return $this->hasOne(Topic::class);
    }
}
