<?php	

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

/*if(!isset($_GET['url']))
{
	header('Location: /public/index.php');
}
else
{*/
    $url = $_GET['url'];
	require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
//}
