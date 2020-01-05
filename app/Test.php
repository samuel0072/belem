<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    /**
     * @var array
     */
    protected $guarded =["id"];

    /**
     * Retorna os AnsweredTest associados
     * @return HasMany
     */
    public function answeredTest() {
        return $this->hasMany(AnsweredTest::class);
    }

    /**
     * Retorna as questoes associadas
     * @return HasMany
     */
    public function questions() {
        return $this->hasMany(Question::class);
    }

    /**
     * Retorna os id de todos os test
     * @return array
     */
    public static function allTests(){
        return [DB::table('tests')->value('id')];
    }

    /** Retorna a disciplina associada
     * @return BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Retorna a classe associada
     * @return BelongsTo
     */
    public function gradeClass() {
        return $this->belongsTo(GradeClass::class);
    }

}
