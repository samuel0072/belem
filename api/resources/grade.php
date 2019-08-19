<?php
include_once __DIR__.'/../util/prepare.php';
include_once __DIR__.'/../school/Grade.php';
include_once __DIR__.'/../school/GradeClass.php';
use \api\School\Grade as Grade;
use \api\School\GradeClass as GradeClass;

function insert_grade($gradeNumber, $schoolId) {
    prepare();
    global $queryBuilder, $db, $response;
    $grade = new Grade($gradeNumber, $schoolId);
    $queryBuilder->insert_into('grade', ['gradeNumber', 'schoolId'])->values(2);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("ii", $gradeNumber, $schoolId);

    if($stm->execute()) {
        $response->ok($gradeNumber);
    }
    else {
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function get_grade($gradeNumber) {
    prepare();
    global $queryBuilder, $db, $response;
    $queryBuilder->select(['*'])->from('grade')->where("gradeNumber = $gradeNumber");
    if($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
    }
    else {
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function insert_class($teacherEnroll,$letter, $gradeNumber, $schoolId) {
    global $response, $db, $queryBuilder;
    prepare();
    $class = new GradeClass($gradeNumber, $letter, $teacherEnroll, $schoolId);
    $queryBuilder->insert_into('gradeclass', ['gradeNumber, teacherEnroll, classLetter'])->values(3);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("iis", $gradeNumber, $teacherEnroll, $letter);
    if($stm->execute()) {
        $response->ok($class);
    }
    else {
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function insert_class_member($schoolmemberid, $classid) {
    global $queryBuilder, $db, $response;
    prepare();
    $queryBuilder->insert_into("classmember", ['schoolmember', 'classid'])->values(2);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("ii", $schoolmemberid, $classid);
    if($stm->execute()) {
        $response->okay();
    }
    else {
        $response->error([$db->get_error(). $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function find_by_criteria($critName, $critValue, $table) {
    global $response, $db, $queryBuilder;
    prepare();
    $queryBuilder->select(["*"])->from($table)->where("$critName = $critValue");
    if($db->query($queryBuilder)) {
        $response->ok($db->fetch_all());
    }
    else{
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }

    return json_encode($response);
}