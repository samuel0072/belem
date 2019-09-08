<?php
include_once __DIR__ . '/../../resources/schoolmember.php';
$router->post('/belem/schoolmember/',
    function($request) {
        $body = $request->getBody();
        echo insert_member($body['name'],$body['age'], $body['gender'], $body['enroll'], $body['school_id'], $body['type'], $body['class_id']);
    }
);