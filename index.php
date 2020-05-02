<script
	src="https://code.jquery.com/jquery-3.5.0.min.js"
	integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
	crossorigin="anonymous">
</script>
<?php
	$page = array(
					'home'	=>	'Accueil',
					'post'	=>	'Article',
					'moderator'	=>	'Moderation'
				);
	session_start();
	define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	var_dump(WEBROOT, ROOT);
	require ROOT.'vendor/autoload.php';
	
	if(!empty($_GET['p'])) {
		$param = explode('/', $_GET['p']);
		$controller = 'APP\\Controllers\\'.$param[0];
		$action = isset($param[1])?$param[1]:'index';
	} else {
		$controller = '';
		$action ='';
	}

	if (class_exists($controller)) {
		$controller = new $controller();

		if (method_exists($controller, $action)) {
			if (isset($page[$param[0]]) && !empty($page[$param[0]])) {
				$param[0] = $page[$param[0]];
			}

			echo APP\AppFactory::getMenu(ucfirst($param[0]));
			unset($param[0]);
			unset($param[1]);
			call_user_func_array(array($controller, $action), $param);
		} else {
			echo APP\AppFactory::getMenu('Accueil');
			$controller = new APP\Controllers\Home;
			call_user_func_array(array($controller, 'error'), array());
		}
		
	} else {
		echo APP\AppFactory::getMenu('Accueil');
		$controller = new APP\Controllers\Home;
		call_user_func_array(array($controller, 'index'), array());
	}