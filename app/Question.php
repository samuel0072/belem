<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    /**
     * @var array
     */
    protected $guarded = ["id"];

    /**
     * Retorna o test associado a questao
     * @return BelongsTo
     */
    public function test() {
        return $this->belongsTo(Test::class);
    }

    /**
     * Retorna o topic associado a questao
     * @return BelongsTo
     */
    public function topic() {
        return $this->belongsTo(Topic::class);
    }
}
