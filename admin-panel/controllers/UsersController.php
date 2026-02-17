<?php
class UsersController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // List users
    public function index() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, username, email, status, created_at FROM users ORDER BY id DESC");
        $users = $stmt->fetchAll();

        $active = 'users';
        $this->view('users', [
            'users' => $users,
            'active' => $active
        ]);
    }

    // Show create form
    public function create() {
        $active = 'users';
        $this->view('users_create', ['active' => $active]);
    }

    // Handle create POST
    public function store() {
        global $pdo;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
            $stmt->execute([$username,$email,$password]);

            header('Location: ' . BASE_URL . '/users');
            exit;
        }
    }

    // Delete user
    public function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);
        header('Location: ' . BASE_URL . '/users');
        exit;
    }

    // Update status
    public function toggleStatus($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT status FROM users WHERE id=?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($user) {
            $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';
            $stmt = $pdo->prepare("UPDATE users SET status=? WHERE id=?");
            $stmt->execute([$newStatus, $id]);
        }

        header('Location: ' . BASE_URL . '/users');
        exit;
    }
}
?>