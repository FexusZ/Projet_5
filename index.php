<script
        src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
        crossorigin="anonymous">
</script>
<?php
$page = array(
    'home' => 'Accueil',
    'post' => 'Article',
    'moderator' => 'Moderation'
);
session_start();
require 'vendor/autoload.php';
$superglobal = new APP\Config\Request();

if (!empty($superglobal->getSession()->get('login'))) {
    
    $ticket = APP\AppFactory::query('SELECT ticket FROM client WHERE ID = :ID', NULL, true, [':ID'  =>  $superglobal->getSession()->get('login')->ID])->ticket;
    
    if ($superglobal->getSession()->get('login')->ticket === $ticket && !empty($superglobal->getSession()->get('login'))) {

        $ticket = bin2hex(random_bytes(64));

        $superglobal->getSession()->setLogin('ticket', $ticket);

        APP\AppFactory::query('UPDATE client SET ticket = :ticket WHERE ID = :ID', NULL, 'No', 
            [':ID'  =>  $superglobal->getSession()->get('login')->ID, ':ticket'  =>  $ticket]);

    } else {

        echo APP\AppFactory::getMenu('Accueil')."\n";
        $controller = new APP\Controllers\Home;
        call_user_func_array(array($controller, 'error'), array());
        exit();
    }
}

if (!empty($superglobal->getGet()->get('p'))) {
    $param = explode('/', $superglobal->getGet()->get('p'));
    $controller = 'APP\\Controllers\\' . $param[0];
    $action = isset($param[1]) ? $param[1] : 'index';
} else {
    $controller = '';
    $action = '';
}

if (class_exists($controller)) {
    $controller = new $controller();

    if (method_exists($controller, $action)) {
        if (isset($page[$param[0]]) && !empty($page[$param[0]])) {
            $param[0] = $page[$param[0]];
        }

        echo APP\AppFactory::getMenu(ucfirst($param[0]))."\n";
        unset($param[0]);
        unset($param[1]);
        call_user_func_array(array($controller, $action), $param);
    } else {
        echo APP\AppFactory::getMenu('Accueil')."\n";
        $controller = new APP\Controllers\Home;
        call_user_func_array(array($controller, 'error'), array());
    }
} else {
    echo APP\AppFactory::getMenu('Accueil')."\n";
    $controller = new APP\Controllers\Home;
    call_user_func_array(array($controller, 'index'), array());
}