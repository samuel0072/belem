<?php


namespace api\School;


class SchoolMember
{
    private $name;
    private $age;
    private $gender;
    private $enrollNumber;
    private $schoolId;

    function __construct($name, $age, $gender, $enrollNumber, $schoolId) {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->enrollNumber = $enrollNumber;
        $this->schoolId = $schoolId;
    }
}