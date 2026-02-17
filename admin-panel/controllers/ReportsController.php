<?php
class ReportsController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    /*public function index() {
        $reportModel = new Report();
        $reports = $reportModel->getAll();
        $this->view('reports', ['active' => 'reports', 'reports' => $reports]);
    }*/

    public function index() {
        global $pdo;

        // Reports stats
        $completed = $pdo->query("SELECT COUNT(*) FROM reports WHERE status='completed'")->fetchColumn();
        $pending = $pdo->query("SELECT COUNT(*) FROM reports WHERE status='pending'")->fetchColumn();
        $in_progress = $pdo->query("SELECT COUNT(*) FROM reports WHERE status='in_progress'")->fetchColumn();

        $stats = [
            'reports' => $pdo->query("SELECT COUNT(*) FROM reports")->fetchColumn(),
            'completed' => $completed,
            'pending' => $pending,
            'in_progress' => $in_progress
        ];

        // Recent reports
        $stmt = $pdo->query("SELECT * FROM reports ORDER BY id DESC LIMIT 10");
        $reports = $stmt->fetchAll();

        $active = 'reports';

        $this->view('reports', [
            'stats' => $stats,
            'reports' => $reports,
            'active' => $active
        ]);
    }

    public function toggleStatus($id) {
        global $pdo;

        // Fetch current status
        $stmt = $pdo->prepare("SELECT status FROM reports WHERE id=?");
        $stmt->execute([$id]);
        $report = $stmt->fetch();

        if ($report) {
            // Cycle status: pending -> in_progress -> completed -> pending
            $nextStatus = [
                'pending' => 'in_progress',
                'in_progress' => 'completed',
                'completed' => 'pending'
            ];

            $newStatus = $nextStatus[$report['status']] ?? 'pending';

            $stmt = $pdo->prepare("UPDATE reports SET status=?, updated_at=NOW() WHERE id=?");
            $stmt->execute([$newStatus, $id]);
        }

        header('Location: ' . BASE_URL . '/reports');
        exit;
    }
}
?>