<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolMember extends Model
{
    /**
     * @var array
     */
    protected $guarded = ["id"];

    /**
     * Retorna os AnsweredTest associados
     * @return HasMany
     */
    public function answeredTests() {
        return $this->hasMany(AnsweredTest::class);
    }

    /**
     * Retorna as GradeClass associadas
     * @return BelongsTo
     */
    public function grade_class(){
        return $this->belongsTo(GradeClass::class);
    }
}
