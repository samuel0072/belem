<?php
include_once __DIR__ . '/../resources/grade.php';
//cria uma classe
$router->post('/belem/class/',
    function($request) {
        $body = $request->getBody();
        echo insert_class($body['letter'], $body['grade_number'], $body['school_id']);
    }
);

//retorna todos os estudantes de uma classe
$router->get('/belem/class/students',
    function($request) {
        $params = $request->getURLParams();
        echo get_class_students($params["class_id"]);
    }
);
//retorna todas as classes de uma escola
$router->get('/belem/classes',
    function($request) {
        $params = $request->getURLParams();
        echo get_all_classes($params["school_id"]);
    }
);