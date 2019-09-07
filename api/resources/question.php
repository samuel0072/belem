<?php

include_once __DIR__ . '/../school/Question.php';
use api\School\Question;

function insert_question($test_id, $correct_answer, $topic_id, $number, $nick, $option_quant) {
    prepare();
    global $queryBuilder, $db, $response;
    $question = new Question((int)$test_id, $correct_answer, (int)$topic_id, (int)$number, $nick, (int)$option_quant);
    $queryBuilder->insert_into('question', ['test_id', 'correct_answer', 'topic_id', 'number', 'nick', 'option_quant'])->values(6);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("iiiisi", $test_id, $correct_answer, $topic_id, $number, $nick, $option_quant);

    if($question->isOkay() && $stm->execute()) {
        $response->ok($db->get_last_insert_id());
    }
    else {
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error():'']);
    }
    return json_encode($response);
}

function update_question($question_id, $test_id, $correct_answer, $topic_id, $number,$nick, $option_quant, $dificult) {
    prepare();
    global $queryBuilder, $db, $response;
    $question = new Question($test_id, $correct_answer, $topic_id, $number, $nick,$option_quant, $dificult);
    $queryBuilder->update('question')
        ->set(['test_id', 'correct_answer', 'topic_id', 'number', 'dificult', 'nick', 'option_quant'], ['?', '?', '?', '?', '?', '?', '?'])
        ->where("id = ?");
    $stm = $db->prepare($queryBuilder->get_query());

    $stm->bind_param("isiissii",$test_id, $correct_answer, $topic_id, $number, $dificult, $nick, $option_quant,$question_id);

    if($question->isOkay() && $stm->execute()) {
        $response->ok(["Questao atualizada"]);
    }
    else {
        $response->error(["verifique os dados informados"]);
    }
    return json_encode($response);
}

function delete_question($question_id) {
    prepare();
    global $queryBuilder, $db, $response;
    $queryBuilder->delete('question', ' id = ?');

    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("i", $question_id);
    if($stm->execute()) {
        $response->ok("Questao deletada");
    }
    else {
        $response->error("verifique os dados informados");
    }
    return json_encode($response);
}


function get_questions_by_test($test_id) {
    prepare();
    global $queryBuilder, $db, $response;

    $queryBuilder->select(["*"])
        ->from("question")
        ->where("test_id= ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("i", $test_id);
    if($stm->execute()) {
        $questions = array();
        $stm->bind_result($id, $test_id, $correct_answer, $topic_id, $number, $dificult, $nick, $option_quant);
        while($stm->fetch()) {
            $string = '{"id":'.$id.' ,"test_id":'. $test_id.',"correct_answer":"'.$correct_answer.'", "topic_id":'.$topic_id.',"number":'.$number.', "dificult":"'.$dificult.'", "nick":"'.$nick.'", "option_quant":'.$option_quant.'}';
            $questions[] = json_decode($string);
        }
        $response->ok($questions);
        $stm->close();
    }
    else {
        $response->error("Verifique os dados informados");
    }
    return json_encode($response);
}

function get_question_by_id($question_id) {
    prepare();
    global $queryBuilder, $db, $response;
    $queryBuilder->select(["*"])->from("question")->where("id= ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("i", $question_id);
    if($stm->execute()) {
        $stm->bind_result($id, $test_id, $correct_answer, $topic_id, $number, $dificult, $nick, $option_quant);
        if($stm->fetch()) {
            $string = '{"id":'.$id.' ,"test_id":'. $test_id.',"correct_answer":"'.$correct_answer.'", "topic_id":'.$topic_id.',"number":'.$number.', "dificult":"'.$dificult.'", "nick":"'.$nick.'", "option_quant":'.$option_quant.'}';
            $response->ok(json_decode($string));
        }
        else {
            $response->error("Nao foi encontrado registro");
        }

    }
    else {
        $response->error("Verifique os dados inseridos");
    }
    return json_encode($response);
}