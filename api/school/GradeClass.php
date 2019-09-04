<?php


namespace api\School;


class GradeClass{
    private $gradeNumber;
    private $classLetter;
    private $schoolId;

    public function __construct($gradeNumber, $classLetter, $schoolId){
        $this->gradeNumber = $gradeNumber;
        $this->classLetter = $classLetter;
        $this->schoolId = $schoolId;
    }


    public function getClassLetter() {
        return $this->classLetter;
    }

    public function isOkay()  {
        $ok = true;
        foreach ($this as $key => $value) {
            if($value == null) {
                $ok = false;
                return $ok;
            }
        }
        if(!is_int($this->teacherEnroll) || !is_string($this->classLetter)) {
            $ok = false;
        }
        else if(!is_int($this->schoolId) || $this->schoolId <= 0) {
            $ok = false;
        }
        else if(strlen($this->classLetter) > 1) {
            $ok = false;
        }

        return $ok;
    }

    public function getGradeNumber(){
        return $this->gradeNumber;
    }

    public function getSchoolId(){
        return $this->schoolId;
    }

}