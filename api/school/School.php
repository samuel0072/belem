<?php


namespace api\School;


class School
{
    private $name;

    function __construct($name, $id = 0)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    function isOkay() {
        $ok = true;
        if($this->name == null || !is_string($this->name)) {
            $ok = false;
        }
    }
}