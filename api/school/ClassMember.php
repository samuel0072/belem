<?php


namespace api\School;


class ClassMember extends SchoolMember
{
    private $classId;

    function __construct($name, $age, $gender, $enrollNumber, $classId, $schoolId)
    {
        parent::__construct($name, $age, $gender, $enrollNumber, $schoolId);
        $this->classId = $classId;
    }

    public function getClassId() {
        return $this->classId;
    }
}