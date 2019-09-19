<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Topic extends Model
{
    protected $guarded = ["id"];

    public function questions() {
        return $this->hasCast(Question::class);
    }

    public static function allTopics(){
        return [DB::table('topics')->value('id')];
    }
}
