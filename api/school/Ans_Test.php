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

    public function isOkay(){
        $ok = true;

        foreach ($this as $key => $value) {
            if($value == null) {
                $ok = false;
                return $ok;
            }
        }

        if(!is_int($this->enroll_number) || !is_int($this->test_id)){
            $ok = false;
        }else if($this->enroll_number <= 0 || $this->test_id <= 0){
            $ok = false;
        }

        return $ok;
    }
}
