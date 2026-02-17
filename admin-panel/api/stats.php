<?php
session_start();
require_once '../config/config.php';
require_once '../core/Database.php'; // or database.php

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

global $pdo;

// Example dynamic stats
$stats = [
    'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
    'reports' => $pdo->query("SELECT COUNT(*) FROM reports")->fetchColumn(),
    'settings' => $pdo->query("SELECT COUNT(*) FROM settings")->fetchColumn(),
    'sessions' => rand(5, 20) // for demo purposes
];

echo json_encode($stats);
?>