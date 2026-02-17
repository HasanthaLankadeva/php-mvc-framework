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

// Reports data
$stmt = $pdo->query("SELECT id, name, status, date FROM reports ORDER BY id DESC LIMIT 10");
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Status counts
$completed = $pdo->query("SELECT COUNT(*) FROM reports WHERE status='completed'")->fetchColumn();
$pending = $pdo->query("SELECT COUNT(*) FROM reports WHERE status='pending'")->fetchColumn();
$in_progress = $pdo->query("SELECT COUNT(*) FROM reports WHERE status='in_progress'")->fetchColumn();

echo json_encode([
    'reports' => $reports,
    'stats' => [
        'completed' => $completed,
        'pending' => $pending,
        'in_progress' => $in_progress
    ]
]);
?>