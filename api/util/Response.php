<?php


namespace util;


class Response
{
    public $error;
    public $object;

    function __construct()
    {
        $this->error = false;
        $this->object = [];
    }
    function error($object = []){
        $this->error = true;
        $this->object[] = $object;
    }
    function ok($object =[]) {
        $this->error = false;
        $this->object = $object;
    }

}