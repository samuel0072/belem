<?php

use api\School\Question;

function insert_question($test_id, $correct_answer, $topic_id, $number) {
    prepare();
    global $queryBuilder, $db, $response;
    $question = new Question($test_id, $correct_answer, $topic_id, $number);
    $queryBuilder->insert_into('question', ['test_id', 'correct_answer', 'topic_id', 'number'])->values(4);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isii", $test_id, $correct_answer, $topic_id, $number);

    if($question->isOkay() && $stm->execute()) {
        $response->ok($db->get_last_insert_id());
    }
    else {
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error():'']);
    }
    return json_encode($response);
}

function update_question($question_id, $test_id, $correct_answer, $topic_id, $number) {
    prepare();
    global $queryBuilder, $db, $response;
    $question = new Question($test_id, $correct_answer, $topic_id, $number);
    $queryBuilder->update('test')
        ->set(['test_id', 'correct_answer', 'topic_id', 'number'], ['?', '?', '?', '?'])
        ->where("id = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isisi",$test_id, $correct_answer, $topic_id, $number, $question_id);

    if($question->isOkay() && $stm->execute()) {
        $response->ok(["Questao atualizada"]);
    }
    else {
        $response->error(["verifique os dados informados"]);
    }
    return json_encode($response);
}