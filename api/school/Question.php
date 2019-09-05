<?php


namespace api\School;


class Question
{
    private $test_id;
    private $correct_answer;
    private $topic_id;
    private $number;
    private $dificult;
    private $nick;

    public function __construct($test_id, $correct_answer, $topic_id, $number,  $nick, $dificult = 'f')
    {
        $this->test_id = $test_id;
        $this->correct_answer = $correct_answer;
        $this->topic_id = $topic_id;
        $this->number = $number;
        $this->dificult = $dificult;
        $this->nick = $nick;
    }


    public function getTestId(){
        return $this->test_id;
    }


    public function getCorrectAnswer(){
        return $this->correct_answer;
    }


    public function getTopicId(){
        return $this->topic_id;
    }


    public function getNumber(){
        return $this->number;
    }

    public function isOkay() {
        $ok = true;
        foreach ($this as $key => $value) {
            if($value == null) {
                echo var_dump([$key, $value]);
                $ok = false;
                break;
            }
        }
        return $ok;
    }

}