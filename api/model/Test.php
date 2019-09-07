<?php

namespace api\School;

class Test{

    private $class_id;
    private $date;
    private $subject_id;
    private $nick;
    private $status;

    public function __construct($class_id, $date, $subject_id, $nick, $status= "inprogress"){
        $this->class_id = $class_id;
        $this->date = $date;
        $this->subject_id = $subject_id;
        $this->nick = $nick;
        $this->status = $status;
    }

    public function getDate(){
        return $this->date;
    } 

    public function getSubjectID(){
        return $this->subject_id;
    }

    public function getClassID(){
        return $this->class_id;
    }
    
    public function isOkay() {
        $ok = true;

        $ints = [$this->class_id, $this->subject_id];

        foreach ($ints as $int) {
            if(!is_int($int)|| $int <= 0) {
                $ok = false;
            }
        }
        
        if($this->date == null){ // TODO: Formatation Check..
            $ok = false;
        }

        return $ok;
    }
}
