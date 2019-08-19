<?php
include_once __DIR__.'/../util/prepare.php';
include_once __DIR__.'/../school/SchoolMember.php';

use api\School\SchoolMember as SchoolMember;

//todo:reoerganizar os parametros
function insert_member(){
    prepare();
    global $response, $queryBuilder, $db;
    //recebe um json com o objeto
    $member= new SchoolMember(json_decode($_POST['member']));
    $queryBuilder->insert_into('schoolmember',
        ['name','age','gender','enrollnumber','schoolid'])->values(5);
    //todo: orgaizar isso
    $stm = $db->prepare($queryBuilder->get_query());
    $name = $member->getName();
    $age  = $member->getAge();
    $gender = $member->getGender();
    $enroll = $member->getEnroll();
    $schoolid = $member->getSchoolId();


    $stm->bind_param("sisii",$name, $age, $gender, $enroll, $schoolid);
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