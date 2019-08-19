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
        extract($request->getBody());
        echo insert_School($name);
    }
);

$router->post('/belem/class/',
    function ($request) {
        extract($request->getBody());
        echo insert_class($teacherEnroll, $letter, $gradeNumber, $schoolId);
    }
);

$router->post('/belem/grade/',
    function($request) {
        extract($request->getBody());
        echo insert_grade($gradeNumber, $schoolId);
    }
);
$router->post('/belem/schoolmember',
    function($request) {
        extract($request->getBody());
        echo insert_member($name,$age, $gender, $enroll, $schoolid);
    }
);
$router->get('/belem/get/',
    function($request) {
        echo "funcionando";
    }
);