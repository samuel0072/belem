<?php


$router->get("/belem/",
    function() {
        header("Content-Type: text/html");
        $include = file_get_contents(__DIR__."/../includes/include.html");
        $var = file_get_contents(__DIR__."/../schoolcreate.html");
        echo $include, $var;
    }
);

$router->get("/belem/scripts/",
    function() {
        header("Content-Type: text/javascript");
        $var = file_get_contents(__DIR__.'/../scripts/schoolcreate.js');
        echo $var;
    }
);
$router->get('/belem/stylesheets', function() {
    header("Content-Type: text/css");
    $var = file_get_contents(__DIR__."/../stylesheets/mdb-css/css/bootstrap.min.css");
    $var2 = file_get_contents(__DIR__."/../stylesheets/mdb-css/css/mdb.min.css");

    echo $var, $var2;
});