<?php

include_once __DIR__ . '/api/router/Router.php';
include_once __DIR__ . '/api/router/IRequest.php';
include_once __DIR__ . '/api/router/Request.php';
include_once __DIR__ . '/api/util/Response.php';


include_once __DIR__ . '/api/resources/schoolmember.php';
include_once __DIR__ . '/api/resources/school.php';
include_once __DIR__ . '/api/resources/grade.php';
include_once __DIR__ . '/api/resources/test.php';
include_once __DIR__ . '/api/resources/question.php';
include_once __DIR__ . '/api/resources/ans_test.php';


use routes\Router as Router;
use routes\Request as Request;
use util\Response;

$router = new Router(new Request);

header("Content-Type: application/json; charset=utf-8");

function customError($errno, $errstr) {
    header("Status Code: 501 Not Implemented");
    $response = new Response();
    $response->error([$errno, $errstr]);
    echo json_encode($response);
    die();
}

set_error_handler("customError");

try {
    $router->post('/belem/school/',
        function($request) {
            $body = $request->getBody();
            echo insert_School($body['name']);
        }
    );

    $router->post('/belem/class/',
        function($request) {
            $body = $request->getBody();
            echo insert_class($body['letter'], $body['grade_number'], $body['school_id']);
        }
    );

//cria um membro da escola
    $router->post('/belem/schoolmember/',
        function($request) {
            $body = $request->getBody();
            echo insert_member($body['name'],$body['age'], $body['gender'], $body['enroll'], $body['school_id'], $body['type'], $body['class_id']);
        }
    );

    $router->post('/belem/test',
        function ($request) {
            $body = $request->getBody();
            echo insert_test($body['class_id'],$body['date'],  $body['subject_id'], $body['nick']);
        }
    );
    $router->post('/belem/test/update',
        function($request) {
            $body = $request->getBody();
            echo update_test($body["test_id"], $body["class_id"], $body["date"], $body["subject_id"], $body["nick"], $body["status"]);
        });
    $router->post('/belem/test/change_status',
        function($request) {
            $body = $request->getBody();
            echo set_test_status($body["test_id"], $body["status"]);
    });

    $router->post('/belem/test/correct',
        function($request) {
            $body = $request->getBody();
            $json = file_get_contents('php://input');
            $var = json_decode($json);
            echo get_test_status($var->test_id);
    });

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

    //cadastrar a resolucao de um aluno
    $router->post('/belem/answered_test',
        function(){
            $json = file_get_contents('php://input');
            $var = json_decode($json);
            echo insert_ans_Test($var->sch_enroll, $var->test_id, $var->questions);
        }
    );
    //atualizar a resolucao de um aluno
    $router->post('/belem/answered_test/update', 
        function(){
            $json = file_get_contents('php://input');
            $var = json_decode($json);
            echo update_ans_Test($var->ans_test_id, $var->answers);
        }
    );
    //excluir a resolucao de um aluno
    $router->post('/belem/answered_test/delete', 
        function($request){
            $body = $request->getBody();
            echo delete_ans_Test($body['answered_test_id']);
        }
    );


    $router->get('/belem/schools/', function () {
        echo get_schools();
    });
    //retorna todos os estudantes de uma classe
    $router->get('/belem/class/students',
        function($request) {
            $params = $request->getURLParams();
            echo get_class_students($params["class_id"]);
        }
    );
    $router->get('/belem/classes',
        function($request) {
            $params = $request->getURLParams();
            echo get_all_classes($params["school_id"]);
        }
    );
    $router->get('/belem/test/class',
        function ($request) {
            $params = $request->getURLParams();
            echo get_tests_by_class($params["class_id"]);
        }
    );
}
catch(Exception $exception) {
    header("Status Code: 501 Not Implemented");
    $response = new Response();
    $response->error("ops, ocorreu um erro interno");
    echo json_encode($response);
}

