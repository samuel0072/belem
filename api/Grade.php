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

}