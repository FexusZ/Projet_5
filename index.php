<?php
// test commit
namespace APP;
use APP\Table\Comment;
require 'vendor/autoload.php';

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 'home';
}


ob_start();

require 'pages/'.$page.'.php';

$content = ob_get_clean();
require 'pages/template/default.php'
?>
