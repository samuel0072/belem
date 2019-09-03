<?php


namespace api\School;


class Grade{
    private $gradeNumber;
    private $schoolId;

    function __construct($gradeNumber, $schoolId){
        $this->gradeNumber = $gradeNumber;
        $this->schoolId = $schoolId;
    }

    public function getSchoolId() {
        return $this->schoolId;
    }

    public function isOkay()  {
        $ok = true;
        foreach ($this as $key => $value) {
            if($value == null || !is_int($value)) {
                $ok = false;
                break;
            }
        }
        return $ok;
    }

    /**
     * @return mixed
     */
    public function getGradeNumber()
    {
        return $this->gradeNumber;
    }


}