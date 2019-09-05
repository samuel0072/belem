<?php
include_once __DIR__ . '/../school/Question.php';
use api\School\Question;

function insert_question($test_id, $correct_answer, $topic_id, $number, $nick) {
    prepare();
    global $queryBuilder, $db, $response;
    $question = new Question((int)$test_id, (int)$correct_answer, (int)$topic_id, (int)$number, $nick);
    $queryBuilder->insert_into('question', ['test_id', 'correct_answer', 'topic_id', 'number', 'nick'])->values(5);
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isiis", $test_id, $correct_answer, $topic_id, $number, $nick);

    if($question->isOkay() && $stm->execute()) {
        $response->ok($db->get_last_insert_id());
    }
    else {
        $response->error(['verifique os dados informados', $db->get_error() ? $db->get_error():'']);
    }
    return json_encode($response);
}

function update_question($question_id, $test_id, $correct_answer, $topic_id, $number,$nick, $dificult) {
    prepare();
    global $queryBuilder, $db, $response;
    $question = new Question($test_id, $correct_answer, $topic_id, $number, $nick, $dificult);
    $queryBuilder->update('test')
        ->set(['test_id', 'correct_answer', 'topic_id', 'number', 'dificult', 'nick'], ['?', '?', '?', '?', '?', '?'])
        ->where("id = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param("isisis",$test_id, $correct_answer, $topic_id, $number, $question_id, $dificult);

    if($question->isOkay() && $stm->execute()) {
        $response->ok(["Questao atualizada"]);
    }
    else {
        $response->error(["verifique os dados informados"]);
    }
    return json_encode($response);
}