<?php

use api\School\Ans_Test;

function insert_ans_Test($enroll_number, $test_id, $answers){

    prepare();
    global $queryBuilder, $db, $response;
    $ans_test = new Ans_Test($enroll_number, $test_id, $answers);
    //$queryBuilder->insert_into('answered_test', ['e']);

}

// algumacoisa = "{
//     test_id:,
//     sch:,
//     questiions: [
//         q1_id: marcou,
//         ...
//     ]
// }"