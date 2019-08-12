<?php
include_once __DIR__.'/../util/Database.php';
include_once __DIR__.'/../util/MySQLDatabase.php';
include_once __DIR__.'/../util/QueryBuilder.php';


include_once __DIR__.'/../school/SchoolMember.php';
include_once  __DIR__.'/../util/Response.php';

use api\School\SchoolMember as SchoolMember;
use util\Response as Response;

$response = new Response();
$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();

if($db->get_error()) {
    $response->error();
    $response->set_object($db->get_error());
    echo json_encode($response);
    die();
}

function insert_member(){
    global $response, $queryBuilder, $db;
    //recebe um json com o objeto
    $member= new SchoolMember(json_decode($_POST['member']));
    $queryBuilder->insert_into('schoolmember',
        ['name','age','gender','enrollnumber','schoolid'])->values(5);

    $stm = $db->prepare($queryBuilder->get_query());
    $name = $member->getName();
    $age  = $member->getAge();
    $gender = $member->getGender();
    $enroll = $member->getEnroll();
    $schoolid = $member->getSchoolId();

    $stm->bind_param("sisii",$name, $age, $gender, $enroll, $schoolid);
    //echo var_dump($stm);
    if($stm->execute())  {
        return get_member($db->get_last_insert_id());
    }
    else {
        $response->error();
        $response->set_object($db->get_error());
        //$response->set_object($queryBuilder->get_query());
        //$response->set_object(var_dump($member));
        return json_encode($response);
    }
}

function get_member($id) {
    global $response, $queryBuilder, $db;
    $queryBuilder->clear();
    $queryBuilder->select('*')->from('schoolmember')->where("id = $id");
    if($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
    }
    else {
        $response->error();
        $response->set_object($db->get_error());
    }
    return json_encode($response);
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        echo insert_member();
        break;
    case 'GET':
        break;
}