<?php

//para o roteamento
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

$router->post('/belem/school/',
    function($request) {
        $body = $request->getBody();
        echo insert_School($body['name']);
    }
);

$router->post('/belem/class/',
    function ($request) {
        $body = $request->getBody();
        echo insert_class($body['teacherEnroll'], $body['letter'], $body['gradeNumber'], $body['schoolId']);
    }
);

$router->post('/belem/grade/',
    function($request) {
        $body = $request->getBody();
        echo insert_grade($body['gradeNumber'], $body['schoolId']);
    }
);

$router->post('/belem/schoolmember/',
    function($request) {
        $body = $request->getBody();
        echo insert_member($body['name'],$body['age'], $body['gender'], $body['enroll'], $body['schoolid'], $body['type']);
    }
);

$router->post('/belem/class/',
    function($request) {
        $body = $request->getBody();
        echo insert_class($body["teacher"], $body["letter"], $body["grade"], $body["school"]);
    }
);
$router->post('/belem/classmember',
    function($request) {
        $body = $request->getBody();
        echo insert_class_member($body["schoolmemberid"], $body["classid"]);
        //echo $body["schoolmemberid"], $body["classid"];
    }
);


$router->get('/belem/get/',
    function($request) {
        echo var_dump($request->getURLParams());
    }
);

$router->get('/belem/class/students',
    function($request) {
        $params = $request->getURLParams();
        echo get_class_students($params["schoolId"], $params["classId"]);
    }
);