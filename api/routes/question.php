<?php
include_once __DIR__ . '/../resources/question.php';
$router->post('/belem/question',
    function($request) {
        $body = $request->getBody();
        echo insert_question($body["test_id"], $body["correct_answer"], $body["topic_id"], $body["number"], $body["nick"], $body["option_quant"]);
    }
);
$router->post('/belem/question/update',
    function($request) {
        $body = $request->getBody();
        echo update_question($body["question_id"], $body["test_id"], $body["correct_answer"], $body["topic_id"], $body["number"], $body["nick"], $body["option_quant"], $body["dificult"]);
    }
);

$router->post('/belem/question/delete',
    function($request) {
        $body = $request->getBody();
        echo delete_question($body["question_id"]);
    }
);