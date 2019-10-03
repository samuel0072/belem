<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnsweredTest extends Model
{
    protected $guarded = ["id"];

    public function questionAnsweredTests() {
        return $this->hasMany(QuestionAnsweredTest::class);
    }

    public function opt_choosed($question_id){
        $ansTests = DB::table('question_answered_tests')->where('answered_test_id', '=', $this->id)->get();
        foreach ($ansTests as $res) {
            if($res->question_id == $question_id) {

                return $res->option_choosed;
            }
        }
        return -19;//vai mostrar '-'
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }
    /*
     * Nao funciona O.O
     * */
    public function student() {
        return $this->belongsTo(SchoolMember::class);
    }

}
