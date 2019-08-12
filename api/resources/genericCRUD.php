<?php

include_once __DIR__.'/../util/Database.php';
include_once __DIR__.'/../util/MySQLDatabase.php';
include_once __DIR__.'/../util/QueryBuilder.php';
include_once  __DIR__.'/../util/Response.php';
use util\Response as Response;

$response = new Response();
$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();

if($db->get_error()) {
    $response->error(true);
    $response->set_object($db->get_error());
    echo json_encode($response);
    die();
}

function get_one($table, $coloum) {
    global $response, $db, $queryBuilder;
    $queryBuilder->clear();
    $queryBuilder->select(['*'])->from($table)->where($coloum[0].'='.$coloum[1]);
    if($db->query($queryBuilder->get_query())) {
        $response->error(false);
        $re = $db->fetch_all();
        foreach ($re as $r) {
            $response->set_object($r);
        }
    }
    else {
        $response->error(true);
        $response->set_object($db->get_error());

    }
    return json_encode($response);

}

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $request = json_decode($_GET['value'], true);
        echo ($request);
        break;
    case 'POST':
        break;
}
