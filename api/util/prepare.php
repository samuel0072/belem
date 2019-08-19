<?php

include_once __DIR__.'/../util/Database.php';
include_once __DIR__.'/../util/MySQLDatabase.php';
include_once __DIR__.'/../util/QueryBuilder.php';
include_once __DIR__.'/Response.php';
use util\Response as Response;


$response = new Response();
$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();

function prepare() {
    global $response, $queryBuilder, $db;
    $response = new Response();
    $db = new MySQLDatabase();
    $queryBuilder = new QueryBuilder();
    if($db->get_error()) {
        $response->error();
        $response->set_object($db->get_error());
        echo json_encode($response);
        die();
    }
}