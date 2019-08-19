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

$router->post('/belem/school/',
    function($request) {
        echo insert_School($request->getBody());
    }
);

$router->post('/belem/class/',
    function ($request) {
        $var = $request->getBody();
        echo insert_class(...$var);
    }
);

$router->post('/belem/grade/',
    function($request) {
        $params = $request->getBody();
        echo insert_grade(...$params);
    }
);
$router->get('/belem/get/',
    function($request) {
        echo "funcionando";
    }
);