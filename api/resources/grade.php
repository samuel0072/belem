<?php

include_once __DIR__.'/../util/prepare.php';
include_once __DIR__.'/../school/GradeClass.php';
include_once __DIR__.'/../school/Test.php';

use \api\School\GradeClass as GradeClass;


function insert_class($classLetter, $gradeNumber, $schoolId) {
    global $response, $db, $queryBuilder;
    prepare();
    $class = new GradeClass((int)$gradeNumber, (string)$classLetter, (int)$schoolId);

    $queryBuilder->insert_into('gradeclass', ['gradeNumber', 'classLetter', 'school_id'])->values(3);
    //echo $queryBuilder->get_query();
    $stm = $db->prepare($queryBuilder->get_query());
    echo $db->get_error();
    $stm->bind_param("isi", $gradeNumber, $classLetter, $schoolId);

    if($class->isOkay() && $stm->execute()) {
        $response->ok($class);
    }
    else {
        $response->error([$db->get_error(), "verificar os dados inseridos"]);
    }
    return json_encode($response);
}

function find_by_criteria($critName, $critValue, $table, $type) {
    global $response, $db, $queryBuilder;
    prepare();
    $queryBuilder->select(["*"])->from($table)->where("$critName = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param($type, $critValue);
    if($stm->execute()) {
        $response->ok([$db->fetch_all()]);
    }
    else{
        $response->error([$db->get_error(), "ops houve algum erro"]);
    }

    return json_encode($response);
}

function get_class_students($schoolId, $classId) {
    global $response, $queryBuilder, $db;
    prepare();
    $queryBuilder->select("C.*")->from("school A, schoolmember C, classmember D")
        ->where("A.id = $schoolId")
        ->where("D.classid = $classId")
        ->where("D.schoolmember = C.enrollnumber")
        ->where("C.type='aluno'");
    if($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
    }
    else{
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function get_grade_class($gradeNumber){
    prepare();
    global $queryBuilder, $db, $response;
    $queryBuilder->select(['*'])->from('Gradeclass')->where("gradeNumber = $gradeNumber");
    if ($db->query($queryBuilder->get_query())) {
        $response->ok($db->fetch_all());
    } else {
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function get_class_student($studentId) {
    return find_by_criteria("schoolmember", $studentId, 'classmember', 'i');
}

function delete_school_member($enrollNumber) {
    global $response, $db, $queryBuilder;
    prepare();
    $queryBuilder->delete('schoolmember', 'schoolmember=?');
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param('i', $enrollNumber);

    if($stm->execute()) {
        $response->ok([$db->fetch_all()]);
    }
    else {
        $response->error([$db->get_error(), "Ocorreu um erro ao deletar. Verificar se as informacoes estao corretas"]);
    }
    return json_encode($response);

}