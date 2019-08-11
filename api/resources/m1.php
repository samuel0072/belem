<?php

//require '/../../vendor/autoload.php';

include __DIR__.'/../school/SchoolMember.php';
include __DIR__.'/../school/ClassMember.php';

use api\School\SchoolMember as SchoolMember;
use api\School\ClassMember as ClassMember;
use Medoo\Medoo;

/*$db = new MySQLDatabase();
$queryBuilder = new QueryBuilder();
*/
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
       $aluno = new ClassMember($_POST["name"], $_POST["age"], $_POST["gender"],
            $_POST["enroll"], $_POST["classid"], $_POST["schoolid"]);
       echo $aluno->getClassId();
       break;
    case 'GET':
        echo '{erro:false, message:"ola"}';
}