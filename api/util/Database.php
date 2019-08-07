<?php

include_once __DIR__.'/QueryBuilder.php';

abstract class Database{
    protected $db_connection;

    public function __construct(){
    }

    public function get_db_connection(){
        return $this->db_connection;
    }
}