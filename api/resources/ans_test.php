<?php

use api\School\Ans_Test;

function insert_ans_Test($enroll_number, $test_id, $answers){

    prepare();
    global $queryBuilder, $db, $response;
    $ans_test;

}

// algumacoisa = "{
//     test_id:,
//     sch:,
//     questiions: [
//         q1_id: marcou,
//         ...
//     ]
// }"