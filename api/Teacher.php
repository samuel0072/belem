<?php


namespace api\School;


class Teacher extends SchoolMember
{
    private $classId;
    private $schoolId;

    function __construct($name, $age, $gender, $enrollNumber, $classId, $schoolId)
    {
        parent::__construct($name, $age, $gender, $enrollNumber);
        $this->classId = $classId;
        $this->schoolId = $schoolId;
    }
}