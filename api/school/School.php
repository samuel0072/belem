<?php


namespace api\School;


class School
{
    private $id;
    private $name;
    private $principal;

    function __construct($name, $id = 0, $principal = 0)
    {
        $this->name = $name;
        $this->id = $id;
        $this->principal = $principal;
    }
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrincipal() {
        return $this->principal;
    }
}