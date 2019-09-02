<?php

include_once __DIR__ . '/api/routes/Router.php';
include_once __DIR__ . '/api/routes/IRequest.php';
include_once __DIR__ . '/api/routes/Request.php';

include_once __DIR__ . '/api/resources/schoolmember.php';
include_once __DIR__ . '/api/resources/school.php';
include_once __DIR__.'/api/resources/grade.php';

use \routes\Router as Router;
use \routes\Request as Request;

$router = new Router(new Request);

header("Content-Type: application/json");

//cria uma escola
$router->post('/belem/school/',
    function($request) {
        $body = $request->getBody();
        echo insert_School($body['name']);
    }
);

//cria uma classe
$router->post('/belem/class/',
    function ($request) {
        $body = $request->getBody();
        echo insert_class($body['teacherEnroll'], $body['letter'], $body['gradeNumber'], $body['schoolId']);
    }
);
//cria uma série
$router->post('/belem/grade/',
    function($request) {
        $body = $request->getBody();
        echo insert_grade($body['gradeNumber'], $body['schoolId']);
    }
);
//cria um membro da escola
$router->post('/belem/schoolmember/',
    function($request) {
        $body = $request->getBody();
        echo insert_member($body['name'],$body['age'], $body['gender'], $body['enroll'], $body['schoolid'], $body['type']);
    }
);

//insere um membro da escola em uma classe
$router->post('/belem/classmember',
    function($request) {
        $body = $request->getBody();
        echo insert_class_member($body["schoolmemberid"], $body["classid"]);
    }
);

//retorna todos os estudantes de uma classe
$router->get('/belem/class/students',
    function($request) {
        $params = $request->getURLParams();
        echo get_class_students($params["schoolId"], $params["classId"]);
    }
);