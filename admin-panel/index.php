<?php
session_start();

// Load config FIRST
require_once __DIR__ . '/config/config.php';

// Database
require_once CORE_PATH . '/Database.php';

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        CORE_PATH,
        CONTROLLER_PATH,
        MODEL_PATH,
        MIDDLEWARE_PATH,
        SERVICE_PATH,
        REPOSITORY_PATH
    ];
    foreach ($paths as $path) {
        $file = $path . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$pdo = Database::connect();

// CSRF check (only after autoloader)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Csrf::validate($_POST[CSRF_TOKEN_NAME] ?? '')) {
        http_response_code(403);
        die('Invalid CSRF token');
    }
}

// Initialize the app
$app = new App($pdo);
?>