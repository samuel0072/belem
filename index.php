<?php

include_once __DIR__ . '/api/router/Router.php';
include_once __DIR__ . '/api/router/IRequest.php';
include_once __DIR__ . '/api/router/Request.php';

include_once __DIR__ . '/api/resources/schoolmember.php';
include_once __DIR__ . '/api/resources/school.php';
include_once __DIR__ . '/api/resources/grade.php';
include_once __DIR__ . '/api/resources/test.php';
include_once __DIR__ . '/api/resources/question.php';

use http\Header;
use \routes\Router as Router;
use \routes\Request as Request;

$router = new Router(new Request);

header("Content-Type: application/json");
header("charset=utf-8");

//cria uma escola
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

//retorna todos os estudantes de uma classe
$router->get('/belem/class/students',
    function($request) {
        $params = $request->getURLParams();
        echo get_class_students($params["schoolId"], $params["classId"]);
    }
);