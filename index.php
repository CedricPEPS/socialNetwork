<?php

require('vendor/autoload.php');

$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
	'cache' => false
]);
define('ASSET', "http://localhost/socialNetwork/templates/asset");
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
require('core/controller.php');

$params = explode('/', $_GET['p']);

if (empty($params[0])) {
	header('Location: home');
}

$controller = $params[0];
$action = isset($params[1]) ? $params[1] : 'index';

require('controller/'.$controller.'.php');
$controller = new $controller();

if (method_exists($controller, $action)) {
	require('core/connect.class.php');
	require('core/hash.class.php');
	session_start();
	$data = $controller->$action();

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	/* special ajax here */

	$data = json_encode($data);
	echo $data;

	}
	else{

	echo $twig->render($params[0].'.twig', $data);
		
	}

} else {
	echo 'erreur 404';
}
