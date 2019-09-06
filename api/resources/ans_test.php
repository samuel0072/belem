<?php

include_once __DIR__ . '/../school/Ans_Test.php';
use api\School\Ans_Test as Ans_Test;

function insert_ans_Test($schoolmember_enroll, $test_id, $answers){

    prepare();
    global $queryBuilder, $db, $response;

    $ans_test = new Ans_Test((int)$schoolmember_enroll, (int)$test_id, $answers);

    $queryBuilder->insert_into('answered_test', ['test_id', 'schoolmember_enroll'])->values(2);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("ii", $test_id, $schoolmember_enroll);

    if($ans_test->isOkay() && $stm->execute()){
        $response->ok($db->get_last_insert_id());

        $queryBuilder->clear();
        $queryBuilder->insert_into('question_answered_test', ['answered_test_id', 'question_id', 'option_choosed'])->values(3);
        $stm = $db->prepare($queryBuilder->get_query());
        $id = $db->get_last_insert_id();

        foreach ($answers as $key => $value){
            $stm->bind_param("iis", $id, $value->id, $value->answer);
            $stm->execute();
        }   

    }else{
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error() : '']);
    }

    return json_encode($response);
}

function update_ans_Test($answered_test_id, $answers){
    prepare();
    global $queryBuilder, $db, $response;

    $queryBuilder->update('question_answered_test')
        ->set(['option_choosed'], ['?'])
        ->where('answered_test_id = ? and question_id = ?');

    $response->ok(["kkk man, fodasi"]);

    foreach ($answers as $key => $value){
        $stm = $db->prepare($queryBuilder->get_query());
        echo $db->get_error();
        $stm->bind_param("sii", $value->answer, $answered_test_id, $value->id);
        if(!$stm->execute()){
            $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error() : '']);
            break;
        }
    }  
    
    return json_encode($response);
}

function delete_ans_Test($answered_test_id){
    prepare();
    global $queryBuilder, $db, $response;

    $queryBuilder->delete('question_answered_test', 'answered_test_id = ?');
    $stm = $db->prepare($queryBuilder->get_query());
    
    $stm->bind_param("i", $answered_test_id);
    
    if($stm->execute()){
        $response->ok(['Deu tudo certin mano']);

        $queryBuilder->clear();
        $queryBuilder->delete('answered_test', 'id = ?');
        $stm = $db->prepare($queryBuilder->get_query());
        $stm->bind_param("i", $answered_test_id);

        if(!$stm->execute()){
            $response->error(['Verifica novamente os dados por favor']);
        }   
    }else{
        $response->error(['Verifica novamente os dados por favor']);
    }

    return json_encode($response);
}

function get_ans_test($test_id){
    prepare();
    global $queryBuilder, $db, $response;

    $queryBuilder
        ->select('*')
        ->from('answered_test')
        ->where('test_id = ? and done = ?');

    $var = 0;
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("ii", $test_id, $var);

    $response->error($db->get_error());

    if($stm->execute()){
        $stm->bind_result($id, $test_id, $schoolmember_enroll, $score, $done);

        while($stm->fetch()){
            $string = '{ 
                "id":'.$id.',
                "test_id":'.$test_id.',
                "schoolmember_enroll":'.$schoolmember_enroll.',
                "score":'.$score.',
                "done":'.$done.'
            }';
            $ans_test[] = json_decode($string);
            $response->ok($ans_test);
        }
    }
    return json_encode($response->object);
}