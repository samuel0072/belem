<?php
include_once __DIR__ . '/../resources/school.php';
$router->post('/belem/school/',
    function($request) {
        $body = $request->getBody();
        echo insert_School($body['name']);
    }
);

$router->get('/belem/schools/', function () {
    echo get_schools();
});