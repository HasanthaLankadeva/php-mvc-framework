<?php
session_start();

// Load .env
require_once __DIR__ . '/../app/core/Env.php';
Env::load(__DIR__ . '/../.env');

// Load global constants
require_once __DIR__ . '/../app/config/config.php';

require APP_PATH . '/libraries/PHPMailer/src/Exception.php';
require APP_PATH . '/libraries/PHPMailer/src/PHPMailer.php';
require APP_PATH . '/libraries/PHPMailer/src/SMTP.php';

// Autoloader for core classes and controllers
spl_autoload_register(function ($class) {
	$paths = [
		APP_PATH . '/core/' . $class . '.php',
		APP_PATH . '/controllers/' . $class . '.php',
		APP_PATH . '/models/' . $class . '.php'
	];

	foreach ($paths as $file) {
		if (file_exists($file)) {
			require_once $file;
			return;
		}
	}
});

// Get the requested URL
$url = $_GET['url'] ?? '';

// Instantiate Router if exists
if (!class_exists('Router')) {
	die('Router class not found.');
}

$router = new Router();
$router->dispatch($url);

?>