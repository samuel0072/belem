<?php

namespace api\School;

class Ans_Test{

    private $enroll_number;
    private $test_id;
    private $map_questions = array();

    public function setEnroll_Number($enroll_number){
        $this->enroll_number = $enroll_number;
    }

    public function setTest_Id($test_id){
        $this->test_id = $test_id;
    }

    public function setQuestion($id, $answer){
        $this->map_questions['$id'] = $answer;
    }
}
