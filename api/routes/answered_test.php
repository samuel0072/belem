<?php

include_once __DIR__ . '/../../resources/ans_test.php';

$router->post('/belem/answered_test/',
    function(){
        $json = file_get_contents('php://input');
        $var = json_decode($json);
        echo insert_ans_Test($var->schoolmember_enroll, $var->test_id, $var->questions);
    }
);
//atualizar a resolucao de um aluno
$router->post('/belem/answered_test/update/',
    function(){
        $json = file_get_contents('php://input');
        $var = json_decode($json);
        echo update_ans_Test($var->ans_test_id, $var->answers);
    }
);
//excluir a resolucao de um aluno
$router->post('/belem/answered_test/delete/',
    function($request){
        $body = $request->getBody();
        echo delete_ans_Test($body['answered_test_id']);
    }
);
//retorna um answered_test pelo id
$router->get('/belem/answered_test/',
    function($request) {
        $params= $request->getURLparams();
        echo get_ans_test_by_id($params["ans_test_id"]);
    }
);

$router->post('/belem/answered_test/correct',
    function($request){
        $body = $request->getBody();
        echo correct_ans_Test($body['test_id']);
    }
);