<?php
include_once __DIR__ . '/../resources/question.php';
//cria uma questao
$router->post('/belem/question',
    function($request) {
        $body = $request->getBody();
        echo insert_question($body["test_id"], $body["correct_answer"], $body["topic_id"], $body["number"], $body["nick"], $body["option_quant"]);
    }
);
//atualiza uma questao
$router->post('/belem/question/update',
    function($request) {
        $body = $request->getBody();
        echo update_question($body["question_id"], $body["test_id"], $body["correct_answer"], $body["topic_id"], $body["number"], $body["nick"], $body["option_quant"], $body["dificult"]);
    }
);
//deleta uma questao
$router->post('/belem/question/delete',
    function($request) {
        $body = $request->getBody();
        echo delete_question($body["question_id"]);
    }
);
//retorna uma questao pelo id
$router->get('/belem/question',
    function($request) {
        $params = $request->getURLParams();
        echo get_question_by_id($params["question_id"]);
    }
);

$router->get('/belem/question/resume',
    function($request) {
        $params = $request->getURLParams();
        echo get_question_resume($params["question_id"]);
    }
);