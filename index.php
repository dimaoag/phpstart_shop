<?php

//$string = '21-11-2015';
//$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
//$replacement = 'Год $3, месяц $2, день $1';  // порядок секций
//echo preg_replace($pattern, $replacement, $string);





ini_set('display_errors',1); // include errors;
error_reporting(E_ALL);



define('ROOT', dirname(__FILE__));
require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/Db.php');

$router = new Router();
$router->run();

?>