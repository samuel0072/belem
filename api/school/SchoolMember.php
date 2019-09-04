<?php


namespace api\School;


class SchoolMember{
    private $name;
    private $age;
    private $gender;
    private $enrollNumber;
    private $schoolId;
    private $type;
    private $classId;


    public function __construct($name, $age, $gender, $enrollNumber, $schoolId, $type, $classId){
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->enrollNumber = $enrollNumber;
        $this->schoolId = $schoolId;
        $this->type = $type;
        $this->classId = $classId;
    }

    public function getClassId(){
        return $this->classId;
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
        $ints = [$this->enrollNumber, $this->schoolId, $this->age, $this->classId];
        $strings = [$this->name, $this->gender, $this->type];
        foreach ($ints as $int) {
            if(!is_int($int)|| $int <= 0) {
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