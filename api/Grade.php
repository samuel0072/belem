<?php


namespace api\School;


class Grade
{
    private $gradeNumber;

    function __construct($gradeNumber)
    {
        $this->gradeNumber = $gradeNumber;
    }

}