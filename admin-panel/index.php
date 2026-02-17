<?php
session_start();

// Load config FIRST
require_once __DIR__ . '/config/config.php';

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        CORE_PATH,
        CONTROLLER_PATH,
        MODEL_PATH
    ];
    foreach ($paths as $path) {
        $file = $path . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Database
require_once CONFIG_PATH . '/database.php';

// CSRF check (only after autoloader)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Csrf::validate($_POST[CSRF_TOKEN_NAME] ?? '')) {
        http_response_code(403);
        die('Invalid CSRF token');
    }
}

// Initialize the app
$app = new App();
?>