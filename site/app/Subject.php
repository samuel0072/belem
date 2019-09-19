<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    public static function allSubjects(){
        return [DB::table('subjects')->value('id')];
    }
}
