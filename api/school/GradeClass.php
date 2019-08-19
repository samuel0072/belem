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
    public function getCapacity() {
        return $this->capacity;
    }
    public function getClassLetter() {
        return $this->classLetter;
    }
}