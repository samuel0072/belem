<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class AnsweredTest extends Model
{
    /**
     * @var array
     */
    protected $guarded = ["id"];

    /**
     * Retorna as respostas do AnsweredTest
     * @return HasMany
     */
    public function questionAnsweredTests() {
        return $this->hasMany(QuestionAnsweredTest::class);
    }

    /**
     * Retorna a opcao escolhida no QuestionansweredTest
     * @param int $question_id
     * @return int
     */

    public function opt_choosed($question_id){
        $ansTests = DB::table('question_answered_tests')
            ->where('answered_test_id', '=', $this->id)
            ->get();
        foreach ($ansTests as $res) {
            if($res->question_id == $question_id) {
                return $res->option_choosed;
            }
        }
        return -19;//vai mostrar '-'
    }

    /**
     * Retorna o test associado ao AnsweredTest
     * @return BelongsTo
     */
    public function test(){
        return $this->belongsTo(Test::class);
    }

    /**
     * Deveria funciona, mas nao funciona.
     * @return BelongsTo
     */
    public function student() {
        return $this->belongsTo(SchoolMember::class);
    }

}
