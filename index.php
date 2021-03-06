<?php

require_once 'config/dev.php';
require_once 'vendor/autoload.php';

use Src\Controller\Router;

if (
	isset($_COOKIE['auth']) 
	&& isset($_COOKIE['email']) 
	&& !empty($_COOKIE['auth']) 
	&& !isset($_SESSION['id'])
) {
	$auth = htmlspecialchars($_COOKIE['auth']);
	$auth = explode('-----', $auth);
	$email = htmlspecialchars($_COOKIE['email']);
	$ip = $_SERVER['REMOTE_ADDR'];

	if (password_verify($email, $auth[0]) && password_verify($ip, $auth[1])) {
		session_start();
		$router = new Router();
		$router->connexionAuto($email);

	} else {
		session_start();
		$router = new Router();
		$router->routerRequest();

	}

} else {
	session_start();
	$router = new Router();
	$router->routerRequest();
}




