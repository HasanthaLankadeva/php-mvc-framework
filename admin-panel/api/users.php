<?php
session_start();
require_once '../config/config.php';
require_once '../core/Database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

global $pdo;

// Recent 10 users
$stmt = $pdo->query("SELECT id, username, email, created_at FROM users ORDER BY id DESC LIMIT 10");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);
?>