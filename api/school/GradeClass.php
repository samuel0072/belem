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

    public function getTeacherEnroll() {
        return $this->teacherEnroll;
    }
    public function getCapacity() {
        return $this->capacity;
    }
    public function getClassLetter() {
        return $this->classLetter;
    }
}