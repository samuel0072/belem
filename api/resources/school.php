<?php
include_once __DIR__.'/../util/Database.php';
include_once __DIR__.'/../util/MySQLDatabase.php';
include_once __DIR__.'/../util/QueryBuilder.php';


include __DIR__.'/../school/School.php';
use api\School\School as School;

$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();
if($db->get_error()) {
    echo json_encode($db->get_error());
    die();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $school = new School($_POST['name']);
        $queryBuilder->insert_into('school', ['name'])->values([$school->getName()]);
        if($db->query($queryBuilder->get_query()))  {
            echo $school->getName();
        }
        else {
            echo json_encode("{erro:true, message:".$db->get_error()."}");
        }
        break;
    case 'GET':
        break;

}