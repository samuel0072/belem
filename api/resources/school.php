<?php
include_once __DIR__.'/../util/Database.php';
include_once __DIR__.'/../util/MySQLDatabase.php';
include_once __DIR__.'/../util/QueryBuilder.php';


include __DIR__.'/../school/School.php';
include  __DIR__.'/../util/Response.php';

use api\School\School as School;
use util\Response as Response;

$response = new Response();
$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();

if($db->get_error()) {
    $response->set_error(true);
    $response->set_object($db->get_error());
    echo json_encode($response);
    die();
}

function insert_School(){
    global $response, $queryBuilder, $db;
    $school = new School($_POST['name']);
    $queryBuilder->insert_into('school', ['name'])->values([$school->getName()]);
    if($db->query($queryBuilder->get_query()))  {
        return get_school($db->get_last_insert_id());
    }
    else {
        $response->set_error(true);
        $response->set_object($db->get_error());
        return json_encode($response);
    }
}

function get_school($id) {
    global $response, $queryBuilder, $db;
    $queryBuilder->clear();
    $queryBuilder->select('*')->from('school')->where("id = $id");
    if($db->query($queryBuilder->get_query())) {
        $response->set_error(false);
        $response->set_object($db->fetch_all());
        return json_encode($response);
    }
    else {
        $response->set_error(true);
        $response->object($db->get_error);
        return json_encode($response);
    }
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        echo insert_School();
        break;
    case 'GET':
        break;

}