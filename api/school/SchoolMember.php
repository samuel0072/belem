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

    public function getName() {
        return $this->name;
    }
    public function getAge() {
        return $this->age;
    }
    public function getGender() {
        return $this->gender;
    }
    public function getEnroll() {
        return $this->enrollNumber;
    }
    public function getSchoolId() {
        return $this->schoolId;
    }
    public function isOkay() {
        $ok = true;
        foreach ($this as $key => $value) {
            if($value == null) {
                $ok = false;
                return $ok;
            }
        }
        $ints = [$this->enrollNumber, $this->schoolId, $this->age];
        $strings = [$this->name, $this->gender, $this->type];
        foreach ($ints as $int) {
            if(!is_int($int)|| $int < 0) {
                $ok = false;
                return $ok;
            }
        }
        foreach ($strings as $string) {
            if(!is_string($string)) {
                $ok = false;
                return $ok;
            }
        }

        return $ok;
    }
}