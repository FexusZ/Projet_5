<?php
// test commit
namespace APP;
use APP\Table\Comment;
require 'vendor/autoload.php';

define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

$param = explode('/', $_GET['p']);
$controller = 'APP\\Controllers\\'.$param[0];
$action = isset($param[1])?$param[1]:'index';


$controller = new $controller();

if (method_exists($controller, $action)) {
	unset($param[0]);
	unset($param[1]);
	call_user_func_array(array($controller, $action), $param);
}