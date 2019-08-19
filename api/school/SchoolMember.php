<?php


namespace api\School;


class SchoolMember
{
    private $name;
    private $age;
    private $gender;
    private $enrollNumber;
    private $schoolId;

    function __construct($name,$age, $gender, $enroll, $schoolId) {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->enrollNumber = $enroll;
        $this->schoolId = $schoolId;
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