<?php
include_once __DIR__.'/../util/prepare.php';
include_once __DIR__.'/../school/SchoolMember.php';

use api\School\SchoolMember as SchoolMember;

//todo:reoerganizar os parametros
function insert_member($name,$age, $gender, $enroll, $schoolid, $type){
    prepare();
    global $response, $queryBuilder, $db;
    $member= new SchoolMember($name,$age, $gender, $enroll, $schoolid, $type);
    $queryBuilder->insert_into('schoolmember',
        ['name','age','gender','enrollnumber','schoolid', 'type'])->values(5);
    //todo: orgaizar isso
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("sisiis",$name, $age, $gender, $enroll, $schoolid);
    //todo: ate aqui
    if($stm->execute())  {
        return get_member($enroll);
    }
    else {
        $response->error([$db->get_error()]);
        return json_encode($response);
    }
}

function get_member($enroll) {
    prepare();
    global $response, $queryBuilder, $db;
    $queryBuilder->clear();
    $queryBuilder->select('*')->from('schoolmember')->where("enrollnumber = $enroll");
    if($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
    }
    else {
        $response->error([$db->get_error()]);
    }
    return json_encode($response);
}