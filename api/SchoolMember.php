<?php


namespace api\School;


class SchoolMember
{
    private $name;
    private $age;
    private $gender;
    private $enrollNumber;

    function __construct($name, $age, $gender, $enrollNumber) {
        $this->$name = $name;
        $this->$age = $age;
        $this->$gender = $gender;
        $this->$enrollNumber = $enrollNumber;
    }
}