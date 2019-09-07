<?php

include_once __DIR__ . '/../resources/test.php';

$router->post('/belem/test',
    function ($request) {
        $body = $request->getBody();
        echo insert_test($body['class_id'], $body['date'], $body['subject_id'], $body['nick']);
    }
);
$router->post('/belem/test/update',
    function($request) {
        $body = $request->getBody();
        echo update_test($body["test_id"], $body["class_id"], $body["date"], $body["subject_id"], $body["nick"], $body["status"]);
    }
);
$router->post('/belem/test/change_status',
    function($request) {
        $body = $request->getBody();
        echo set_test_status($body["test_id"], $body["status"]);
    }
);
$router->post('/belem/test/correct',
    function($request) {
        $body = $request->getBody();
        $json = file_get_contents('php://input');
        $var = json_decode($json);
        echo get_test_status($var->test_id);
    }
);

$router->get('/belem/test/class',
    function ($request) {
        $params = $request->getURLParams();
        echo get_tests_by_class($params["class_id"]);
    }
);
$router->get('/belem/test/questions',
    function($request) {
        $params = $request->getURLparams();
        echo get_questions_by_test($params["test_id"]);
    }
);
$router->get('/belem/test/',
    function($request){
        $params = $request->getURLParams();
        echo get_test_byID($params["test_id"]);
    }
);