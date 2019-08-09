<?php


namespace api\School;


class Grade
{
    private $gradeNumber;
    private $schoolId;

    function __construct($gradeNumber, $schoolId)
    {
        $this->gradeNumber = $gradeNumber;
        $this->schoolId = $schoolId;
    }

    public function getGradeNumber() {
        return $this->gradeNumber;
    }
    public function getSchoolId() {
        return $this->schoolId;
    }

}