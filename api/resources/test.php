<?php

use api\School\Test;

include_once __DIR__.'/../util/prepare.php';

function insert_test($class_id, $date, $subject_id, $nick = "sem titulo") {
    prepare();
    global $queryBuilder, $db, $response;
    $test = new Test($class_id, $date, $subject_id, $nick);
    $queryBuilder->insert_into('test', ['class_id', 'date', 'subject_id', 'nick'])->values(4);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isis", $class_id, $date, $subject_id, $nick);

    if($test->isOkay() && $stm->execute()) {
        $response->ok($db->get_last_insert_id());
    }
    else {
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error():'']);
    }
    return json_encode($response);
}

function update_test($test_id, $class_id, $date, $subject_id, $nick) {
    prepare();
    global $queryBuilder, $db, $response;
    $test = new Test($class_id, $date, $subject_id, $nick);
    $queryBuilder->update('test')
        ->set(['class_id', 'date', 'subject_id', 'nick'], ['?', '?', '?', '?'])
        ->where("id = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isisi",$class_id, $date, $subject_id, $nick, $test_id);

    if($test->isOkay() && $stm->execute()) {
        $response->ok(["Teste atualizado"]);
    }
    else {
        $response->error(["verifique os dados informados"]);
    }
    return json_encode($response);
}