<?php

use api\School\Test;

include_once __DIR__ . '/../util/prepare.php';
include_once __DIR__.'/ans_test.php';

function insert_test($class_id, $date, $subject_id, $nick = "sem titulo")
{
    prepare();
    global $queryBuilder, $db, $response;
    $test = new Test((int)$class_id, (string)$date, (int)$subject_id, (string)$nick);
    $queryBuilder->insert_into('test', ['class_id', 'dt', 'subject_id', 'nick'])->values(4);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isis", $class_id, $date, $subject_id, $nick);

    if ($test->isOkay() && $stm->execute()) {
        $response->ok($db->get_last_insert_id());
    } else {
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error() : '']);
    }
    return json_encode($response);
}

function update_test($test_id, $class_id, $date, $subject_id, $nick, $status){
    prepare();
    global $queryBuilder, $db, $response;
    $test = new Test((int)$class_id, (string)$date, (int)$subject_id, (string)$nick, (string)$status);
    $queryBuilder->update('test')
        ->set(['class_id', 'dt', 'subject_id', 'nick', 'status'], ['?', '?', '?', '?' ,'?'])
        ->where("id = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isisis", $class_id, $date, $subject_id, $nick, $test_id, $status);

    if ($test->isOkay() && $stm->execute()) {
        $response->ok(["Prova atualizada"]);
    } else {
        $response->error(["verifique os dados informados"]);
    }
    return json_encode($response);
}

function set_test_status($test_id, $status) {
    prepare();
    global $queryBuilder, $db, $response;
    $queryBuilder->update('test')
        ->set(['status'], ['?'])
        ->where("id=?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("si", $status, $test_id);
    if($stm->execute()) {
        $response->ok("Estado mudado");
    }
    else {
        $response->error("Verifique os dados inseridos");
    }
    return json_encode($response);
}

function get_tests_by_class($class_id) {
    prepare();
    global $queryBuilder, $db, $response;
    $queryBuilder->select(["*"])->from("test")
        ->where("class_id = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("i", $class_id);

    if($stm->execute()) {
        $test = array();
        $stm->bind_result($id, $dt, $class_id, $subject_id, $nick, $status);
        while($stm->fetch()) {
            $string = '{"id":'.$id.' ,"date":"'. $dt.'","class_id":'.$class_id.', "subject_id":'.$subject_id.', "nick":"'.$nick.'", "status":"'.$status.'", "class_id":'.$class_id.'}';
            $test[] = json_decode($string);
        }
        $response->ok($test);
        $stm->close();
    }
    else {
        $response->error($db->get_error());
    }
    return json_encode($response);
}

function get_test_status($test_id){

    prepare();
    global $queryBuilder, $db;

    $queryBuilder->clear();
    
    $queryBuilder
        ->select('status')
        ->from('test')
        ->where("id = ?");

    $stm = $db->prepare($queryBuilder->get_query());    
    $stm->bind_param("i", $test_id);
    $status = "inprogress";
    
    if($stm->execute()){

        $stm->bind_result($status);
        $stm->fetch();
        $stm->close();


    }
    return $status;
}

function get_test_byID($test_id){

    prepare();
    global $queryBuilder, $db, $response;
    
    $queryBuilder
        ->select(['id', 'status'])
        ->from('test')
        ->where("id = ?");

    $stm = $db->prepare($queryBuilder->get_query());    
    $stm->bind_param("i", $test_id);
    
    if($stm->execute()){

        $stm->bind_result($id, $status);

        if($stm->fetch()){
            $test = json_decode('{"id",'.$id.' "status": "'.$status.'"}');
            $response->ok($test);
        }

    }else{
        $response->error($db->get_error());
    }
    return json_encode($response);
}

function correct_test($test_id, $class_id){
    prepare();
    global $queryBuilder, $db, $response;

    if(get_test_status($test_id) == "ready"){
        $test = get_tests_by_class($class_id);
        $ans_test = get_ans_test($test_id);


    }
}