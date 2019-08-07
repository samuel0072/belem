<?php


namespace api\School;


class GradeClass extends Grade
{
    private $teacherEnroll;
    private $capacity;
    private $classLetter;

    function __construct($gradeNumber, $capacity, $classLetter, $teacherEnroll, $schoolId)
    {
        parent::__construct($gradeNumber, $schoolId);
        $this->capacity = $capacity;
        $this->classLetter = $classLetter;
        $this->teacherEnroll = $teacherEnroll;
    }
}