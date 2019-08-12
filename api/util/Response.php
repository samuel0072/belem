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
    function set_error($error){
        $this->error = $error;
    }
    function set_object($object) {
        $this->object[] = $object;
    }
}