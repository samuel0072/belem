<?php
include_once __DIR__.'/../util/prepare.php';
include_once __DIR__.'/../school/School.php';

use api\School\School as School;



function insert_School($name){
    prepare();
    global $response, $db, $queryBuilder;
    $school = new School($name);
    $queryBuilder->insert_into('school', ['name'])->values(1);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("s",$name);
    if( $school->isOkay() && $stm->execute() )  {
        return get_school($db->get_last_insert_id());
    }
    else {
        $response->error("Verificar os dados informados");
        return json_encode($response);
    }
}

function get_school($id) {
    prepare();
    global $response, $queryBuilder, $db;
    $queryBuilder->clear();
    $queryBuilder->select('*')->from('school')->where("id = $id");
    if($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
        return json_encode($response);
    }
    else {
        $response->error([$db->get_error(),$queryBuilder->get_query() ]);
        return json_encode($response);
    }
}

function get_schools() {
    prepare();
    global $response, $queryBuilder, $db;
    $queryBuilder->clear();
    $queryBuilder->select('*')->from('school');
    if($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
        return json_encode($response);
    }
    else {
        $response->error([$db->get_error(),$queryBuilder->get_query() ]);
        return json_encode($response);
    }
}
