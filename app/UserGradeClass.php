<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGradeClass extends Model
{
    //
    protected $guarded = ['id'];

    public function clazz() {
        return $this->belongsTo(GradeClass::class);
    }
}
