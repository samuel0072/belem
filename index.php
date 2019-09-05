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

use routes\Router as Router;
use routes\Request as Request;
use util\Response;

$router = new Router(new Request);

header("Content-Type: application/json");
header("charset=utf-8");
try {
    $router->post('/belem/school/',
        function($request) {
            $body = $request->getBody();
            echo insert_School($body['name']);
        }
    );

//cria uma serie
    $router->post('/belem/class/',
        function($request) {
            $body = $request->getBody();
            echo insert_class($body['letter'], $body['gradeNumber'], $body['schoolId']);
        }
    );
//cria um membro da escola
    $router->post('/belem/schoolmember/',
        function($request) {
            $body = $request->getBody();
            echo insert_member($body['name'],$body['age'], $body['gender'], $body['enroll'], $body['schoolid'], $body['type'], $body['class_id']);
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

    $router->post('/belem/question',
        function($request) {
            $body = $request->getBody();
            echo insert_question($body["test_id"], $body["correct_answer"], $body["topic_id"], $body["number"], $body["nick"]);
        }
    );

    //cadastrar, atualizar e excluir a resolucao de um aluno
    $router->post('/belem/answered_test', 
        function($request){
            $body = $request->getBody();
            $var = json_decode($body[""]); //TODO:
            //echo insert_ans_Test($var.e)
        }
    );

    $router->get('/belem/schools/', function () {
        echo get_schools();
    });
//retorna todos os estudantes de uma classe
    $router->get('/belem/class/students',
        function($request) {
            $params = $request->getURLParams();
            echo get_class_students($params["schoolId"], $params["classId"]);
        }
    );
}
catch(Exception $exception) {
    $response = new Response();
    $response->error("ops, ocorreu um erro interno");
    echo json_encode($response);
}

