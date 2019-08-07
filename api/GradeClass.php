<?php


namespace api\School;


class GradeClass extends Grade
{
    private $teacher;
    private $capacity;
    private $classLetter;

    function __construct($gradeNumber, $capacity, $classLetter, $teacher)
    {
        parent::__construct($gradeNumber);
        $this->capacity = $capacity;
        $this->classLetter = $classLetter;
        $this->teacher = $teacher;
    }

}