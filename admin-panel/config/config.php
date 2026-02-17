<?php
/**
 * Application Configuration
 * Centralized config for paths, URLs, DB, etc.
 */

// ---------- APP PATHS ----------
define('ROOT_PATH', dirname(__DIR__)); // /template/admin-panel
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('APP_PATH', ROOT_PATH);
define('CORE_PATH', APP_PATH . '/core');
define('CONTROLLER_PATH', APP_PATH . '/controllers');
define('MODEL_PATH', APP_PATH . '/models');
define('VIEW_PATH', APP_PATH . '/views');
define('CONFIG_PATH', APP_PATH . '/config');

// ---------- BASE URL ----------
define('BASE_URL', '/template/admin-panel');

// ---------- DATABASE ----------
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc_admin');
define('DB_USER', 'root');
define('DB_PASS', '');

// ---------- ENV ----------
define('APP_NAME', 'Admin Panel');
define('APP_ENV', 'local'); // local | production

// ---------- SECURITY ----------
define('CSRF_TOKEN_NAME', '_csrf_token');
define('CSRF_TOKEN_LENGTH', 32);

define('DEFAULT_TABLE_FIELDS', [
    'moduleID' => [
        'type' => 'INT',
        'nullable' => false
    ],
    'parentID' => [
        'type' => 'INT',
        'nullable' => false
    ],
    'name' => [
        'type' => 'VARCHAR(255)',
        'nullable' => false
    ],
    'created_at' => [
        'type' => 'DATETIME',
        'nullable' => false,
        'default' => 'CURRENT_TIMESTAMP'
    ]
]);

define('FIELD_TYPES', [
    'text'     => 'Text',
    'textarea' => 'Textarea',
    'number'   => 'Number',
    'date'     => 'Date',
    'file'     => 'File',
    'image'    => 'Image'
]);
?>