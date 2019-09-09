<?php
include_once __DIR__ . '/../resources/school.php';
$router->post('/belem/school/',
    function($request) {
        header("Content-Type: application/json");
        $body = $request->getBody();
        echo insert_School($body['name']);
    }
);

$router->get('/belem/schools/', function () {
    header("Content-Type: application/json");
    echo get_schools();
});

