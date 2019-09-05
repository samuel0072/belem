<?php

use api\School\Ans_Test;

function insert_ans_Test($enroll_number, $test_id, $answers){

    prepare();
    global $queryBuilder, $db, $response;

    $ans_test = new Ans_Test($enroll_number, $test_id, $answers);

    $queryBuilder->insert_into('answered_test', ['test_id', 'schoolmember_enroll'])->values(2);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("ii", $test_id, $enroll_number);

    if($ans_test->isOkay() && $stm->execute()){
        $response->ok($db->get_last_insert_id());
    }else{
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error() : '']);
    }

    return json_encode($response);
}

function