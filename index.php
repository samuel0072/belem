<?php

//para o roteamento
include_once __DIR__ . '/api/routes/sources/Router.php';
include_once __DIR__ . '/api/routes/sources/IRequest.php';
include_once __DIR__ . '/api/routes/sources/Request.php';


//

include_once __DIR__ . '/api/resources/schoolmember.php';
include_once __DIR__ . '/api/resources/school.php';

use \routes\Router as Router;
use \routes\Request as Request;

$router = new Router(new Request);

$router->post('/belem/', function($request) {
    echo insert_School($request->getBody());
});

$router->get('/belem/', function() {
   echo "funcionando";
});