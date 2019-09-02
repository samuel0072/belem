<?php


namespace api\School;


class ClassMember extends SchoolMember
{
    private $classId;

    function __construct($name, $age, $gender, $enrollNumber, $classId, $schoolId, $type)
    {
        parent::__construct($name, $age, $gender, $enrollNumber, $schoolId, $type);
        $this->classId = $classId;
    }

    public function getClassId() {
        return $this->classId;
    }

    public function isOkay() {
        $ok = true;
        if(!parent::isOkay()) {
            $ok = false;
        }
        else if($this->classId == null || !is_int($this->classId) || $this->classId <= 0) {
            $ok = false;
        }
        return $ok;
    }
}