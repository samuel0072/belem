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
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isi", $gradeNumber, $classLetter, $schoolId);

    if($class->isOkay() && $stm->execute()) {
        $response->ok($db->get_last_insert_id());
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

function get_class_students($classId) {
    global $response, $queryBuilder, $db;
    prepare();
    $queryBuilder->select(["C.*"])->from("schoolmember C")
        ->where("C.class_id=?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("i", $classId);
    if($stm->execute()) {
        $students = array();
        $stm->bind_result($enroll_number, $name, $age, $gender, $type, $school_id, $class_id);
        while($stm->fetch()) {
            $string = '{"enroll_number":'.$enroll_number.' ,"name":"'. $name.'","age":'.$age.', "gender":"'.$gender.'", "type":"'.$type.'", "school_id":'.$school_id.', "class_id":'.$class_id.'}';
            $students[] = json_decode($string);
        }
        $response->ok($students);
        $stm->close();
    }
    else{
        $response->error([$db->get_error(), $queryBuilder->get_query()]);
    }
    return json_encode($response);
}

function get_all_classes($school_id) {
    global $response, $db, $queryBuilder;
    prepare();
    $queryBuilder->select(["*"])->from("gradeclass")->where("school_id = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("i", $school_id);
    echo $db->get_error();
    if($stm->execute()) {
        $classes = array();
        $stm->bind_result($id, $classLetter, $gradeNumber, $school_id2);
        while($stm->fetch()) {
            $string = '{"id":'.$id.' ,"grade_number":'. $gradeNumber.',"class_letter":"'.$classLetter.'"}';
            $classes[] = json_decode($string);
        }
        $response->ok($classes);
        $stm->close();
    }
    else {
        $response->error($db->get_error());
    }
    return json_encode($response);
}