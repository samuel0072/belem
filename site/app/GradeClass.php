<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeClass extends Model
{
    //

    public function school() {
        return $this->belongsTo(School::class);
    }
}
