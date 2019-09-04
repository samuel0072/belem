<?php


namespace api\School;


class Question
{
    private $test_id;
    private $correct_answer;
    private $topic_id;
    private $number;


    public function __construct($test_id, $correct_answer, $topic_id, $number)
    {
        $this->test_id = $test_id;
        $this->correct_answer = $correct_answer;
        $this->topic_id = $topic_id;
        $this->number = $number;
    }

}