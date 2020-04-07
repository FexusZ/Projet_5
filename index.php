<?php
namespace Fexus;
// test commit
require 'APP/autoload.php';

Autoload::register();

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 'home';
}

$dbh = new Database('Expressfood');

ob_start();

require 'pages/'.$page.'.php';

$content = ob_get_clean();
require 'pages/template/default.php'
?>
