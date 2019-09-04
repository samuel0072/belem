<?php
include_once __DIR__.'/../util/prepare.php';
include_once __DIR__.'/../school/SchoolMember.php';

use api\School\SchoolMember as SchoolMember;

function insert_member($name,$age, $gender, $enroll, $schoolid, $type, $class_id){
    prepare();

    global $response, $queryBuilder, $db;
    $member= new SchoolMember($name,$age, $gender, $enroll, $schoolid, $type);

    $queryBuilder->insert_into('schoolmember', ['name','age','gender','enrollnumber','schoolid', 'type', 'class_is'])
        ->values(6);

    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("sisiisi",$name, $age, $gender, $enroll, $schoolid, $class_id);

    if($member->isOkay() && $stm->execute())  {
        return get_member($enroll);
    }
    else {
        $response->error([$db->get_error(), "verificar os dados informados"]);
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