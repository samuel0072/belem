<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class QuestionAnsweredTest
 * @package App
 */
class QuestionAnsweredTest extends Model
{

    /**
     * @var array
     */
    protected $guarded =["id"];

    /**
     * Retorna o AnsweredTest associado
     * @return BelongsTo
     */
    public function ansTest() {
        return $this->belongsTo(AnsweredTest::class);
    }

    /** Retorna o test associado
     * @return Test
     */
    public function test(){
        return $this->ansTest->test;
    }
}
