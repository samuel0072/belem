<?php

require '../../vendor/autoload.php';
include_once __DIR__.'/../school/SchoolMember.php';
include_once __DIR__.'/../school/ClassMember.php';

//include_once

//use api\School\ClassMember;
use Medoo\Medoo;

/*$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();
*/
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
       $aluno = new ClassMember($_POST['name'], $_POST['age'], $_POST['gender'],
            $_POST['enroll'], $_POST['classid'], $_POST['schoolid']);
       echo $aluno->name;
        break;
}