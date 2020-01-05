<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserGradeClass extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Retorna as class associada
     * @return BelongsTo
     */
    public function clazz() {
        return $this->belongsTo(GradeClass::class);
    }
}
