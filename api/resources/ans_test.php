<?php

include_once __DIR__ . '/../school/Ans_Test.php';
use api\School\Ans_Test as Ans_Test;

function insert_ans_Test($enroll_number, $test_id, $answers){

    prepare();
    global $queryBuilder, $db, $response;

    $ans_test = new Ans_Test((int)$enroll_number, (int)$test_id, $answers);

    $queryBuilder->insert_into('answered_test', ['test_id', 'schoolmember_enroll'])->values(2);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("ii", $test_id, $enroll_number);

    if($ans_test->isOkay() && $stm->execute()){
        $response->ok($db->get_last_insert_id());

        $queryBuilder->clear();
        $queryBuilder->insert_into('question_answered_test', ['answered_test_id', 'question_id', 'option_choosed'])->values(3);
        $stm = $db->prepare($queryBuilder->get_query());
        $id = $db->get_last_insert_id();

        foreach ($answers as $key => $value){
            $stm->bind_param("iis", $id, $key, $value);
        }   

    }else{
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error() : '']);
    }

    return json_encode($response);
}

function update_ans_Test(){

}

// function update_test($test_id, $class_id, $date, $subject_id, $nick, $status)
// {
//     prepare();
//     global $queryBuilder, $db, $response;
//     $test = new Test((int)$class_id, (string)$date, (int)$subject_id, (string)$nick, (string)$status);
//     $queryBuilder->update('test')
//         ->set(['class_id', 'dt', 'subject_id', 'nick', 'status'], ['?', '?', '?', '?' ,'?'])
//         ->where("id = ?");
//     $stm = $db->prepare($queryBuilder->get_query());
//     $stm->bind_param("isisis", $class_id, $date, $subject_id, $nick, $test_id, $status);

//     if ($test->isOkay() && $stm->execute()) {
//         $response->ok(["Prova atualizada"]);
//     } else {
//         $response->error(["verifique os dados informados"]);
//     }
//     return json_encode($response);
// }