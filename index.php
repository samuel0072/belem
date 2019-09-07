<?php

include_once __DIR__ . '/api/router_implementation/Router.php';
include_once __DIR__ . '/api/router_implementation/IRequest.php';
include_once __DIR__ . '/api/router_implementation/Request.php';
include_once __DIR__ . '/api/util/Response.php';

use routes\Router as Router;
use routes\Request as Request;
use util\Response;

$router = new Router(new Request);

header("Content-Type: application/json; charset=utf-8");

function customError($errno, $errstr) {
    //header("Status Code: 501 Not Implemented");
    $response = new Response();
    $response->error([$errno, $errstr]);
    echo json_encode($response);
    die();
}

//set_error_handler("customError");

try {

    include_once __DIR__ . '/api/routes/answered_test.php';
    include_once __DIR__ . '/api/routes/gradeclass.php';
    include_once __DIR__ . '/api/routes/question.php';
    include_once __DIR__ . '/api/routes/school.php';
    include_once __DIR__ . '/api/routes/schoolmember.php';
    include_once __DIR__ . '/api/routes/test.php';

}
catch(Exception $exception) {
    header("Status Code: 501 Not Implemented");
    $response = new Response();
    $response->error("ops, ocorreu um erro interno");
    echo json_encode($response);
}

