<?php


namespace api\School;


class SchoolMember
{
    private $name;
    private $age;
    private $gender;
    private $enrollNumber;
    private $schoolId;

    function __construct($object) {
        $this->name = $object->name;
        $this->age = $object->age;
        $this->gender = $object->gender;
        $this->enrollNumber = $object->enrollNumber;
        $this->schoolId = $object->schoolId;
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