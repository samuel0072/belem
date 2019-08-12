<?php


namespace util;


class Response
{
    public $error;
    public $object;

    function __construct()
    {
        $error = false;
        $object = [];
    }
    function error(){
        $this->error = true;
    }
    function set_object($object = []) {
        $this->object[] = $object;
    }
    function ok($object) {
        $this->error = false;
        $this->object = $object;
    }

}