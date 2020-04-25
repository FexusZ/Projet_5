<script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
<?php
	session_start();
	define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	require ROOT.'vendor/autoload.php';
	$param = explode('/', $_GET['p']);
	$controller = 'APP\\Controllers\\'.$param[0];
	$action = isset($param[1])?$param[1]:'index';

	if (class_exists($controller))
	{
		$controller = new $controller();
		if (method_exists($controller, $action)) 
		{
			echo APP\AppFactory::getMenu(ucfirst($param[0]));
			unset($param[0]);
			unset($param[1]);

			call_user_func_array(array($controller, $action), $param);
		}
	}
	else
	{
		echo APP\AppFactory::getMenu('Home');
		$controller = new APP\Controllers\Home;
		call_user_func_array(array($controller, 'index'), array());
	}