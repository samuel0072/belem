<?php


namespace api\School;


class SchoolMember
{
    private $name;
    private $age;
    private $gender;
    private $enrollNumber;
    private $schoolId;
    private $type;

    function __construct($name,$age, $gender, $enroll, $schoolId, $type) {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->enrollNumber = $enroll;
        $this->schoolId = $schoolId;
        $this->type = $type;
    }

    function getName() {
        return $this->name;
    }
    function getAge() {
        return $this->age;
    }
    function getGender() {
        return $this->gender;
    }
    function getEnroll() {
        return $this->enrollNumber;
    }
    function getSchoolId() {
        return $this->schoolId;
    }
}