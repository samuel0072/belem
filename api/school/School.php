<?php


namespace api\School;


class School
{
    private $id;
    private $name;
    private $principal;

    function __construct( $id, $name, $principal)
    {
        $this->name = $name;
        $this->id = $id;
        $this->principal = $principal;
    }
}