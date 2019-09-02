<?php


namespace api\School;


class GradeClass extends Grade
{
    private $teacherEnroll;
    private $classLetter;

    function __construct($gradeNumber, $classLetter, $teacherEnroll, $schoolId)
    {
        parent::__construct($gradeNumber, $schoolId);
        $this->classLetter = $classLetter;
        $this->teacherEnroll = $teacherEnroll;
    }

    public function getTeacherEnroll() {
        return $this->teacherEnroll;
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
        else if(strlen($this->classLetter) > 1) {
            $ok = false;
        }

        return $ok;
    }
}