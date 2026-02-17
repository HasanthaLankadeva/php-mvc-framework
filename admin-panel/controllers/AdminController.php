<?php
class AdminController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function dashboard() {
        global $pdo;

        // Stats counts
        $stats = [
            'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'reports' => $pdo->query("SELECT COUNT(*) FROM reports")->fetchColumn(),
            'settings' => $pdo->query("SELECT COUNT(*) FROM settings")->fetchColumn(),
            'sessions' => rand(5, 20) // example
        ];

        // Recent users
        $stmt = $pdo->query("SELECT id, username, email, created_at FROM users ORDER BY id DESC LIMIT 5");
        $recentUsers = $stmt->fetchAll();

        // Chart data
        $chartData = [
            'months' => ['Jan','Feb','Mar','Apr','May','Jun'], // example, can generate dynamically
            'values' => [5, 10, 8, 12, 15, 20]
        ];

        // Active menu
        $active = 'dashboard';

        $this->view('dashboard', [
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'chartData' => $chartData,
            'active' => $active
        ]);
    }

    public function users() {
        global $pdo;
        $stats = [
            'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'active_users' => 15,
            'new_users' => 5
        ];
        $stmt = $pdo->query("SELECT id, username, email, created_at FROM users ORDER BY id DESC LIMIT 10");
        $users = $stmt->fetchAll();
        $chartData = [
            'months' => ['Jan','Feb','Mar','Apr','May','Jun'],
            'values' => [5,10,8,12,15,20]
        ];
        $this->view('users', compact('stats','users','chartData','active'));
    }

    public function reports() {
        global $pdo;
        $stats = [
            'reports' => $pdo->query("SELECT COUNT(*) FROM reports")->fetchColumn(),
            'completed' => 12,
            'pending' => 5,
            'in_progress' => 3
        ];
        $stmt = $pdo->query("SELECT id, name, status, date FROM reports ORDER BY id DESC LIMIT 10");
        $reports = $stmt->fetchAll();
        $this->view('reports', compact('stats','reports','active'));
    }

    public function settings() {
        global $pdo;
        $stats = [
            'total' => $pdo->query("SELECT COUNT(*) FROM settings")->fetchColumn()
        ];
        $stmt = $pdo->query("SELECT id, name, value FROM settings");
        $settings = $stmt->fetchAll();
        $this->view('settings', compact('stats','settings','active'));
    }
}
?>