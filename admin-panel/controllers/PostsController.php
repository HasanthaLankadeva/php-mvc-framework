<?php
class PostsController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // List all posts
    public function index() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM modules ORDER BY id DESC");
        $modules = $stmt->fetchAll();
        $active = 'posts';
        $this->view('posts/index', ['modules' => $modules, 'active' => $active]);
    }

    // Show all posts
    public function manage($module_id) {
        global $pdo;

        // Get main table
        $stmt = $pdo->prepare("SELECT id FROM module_tables WHERE module_id=? AND is_main=?");
        $stmt->execute([$module_id, '1']);
        $maintable = $stmt->fetch();

        // Get fields
        $stmt = $pdo->prepare("SELECT * FROM module_fields WHERE table_id=?");
        $stmt->execute([$maintable['id']]);
        $fields = $stmt->fetchAll();

        $active = 'posts';
        $this->view('posts/manage', [
            'table' => $maintable,
            'fields' => $fields,
            'active' => $active
        ]);
    }

    // Show add posts
    public function create() {
        $active = 'posts';
        $this->view('posts/create', ['active' => $active]);
    }

    // Handle posts edit
    public function edit() {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $stmt = $pdo->prepare("INSERT INTO modules (name) VALUES (?)");
            $stmt->execute([$name]);
            header('Location: ' . BASE_URL . '/modules');
            exit;
        }
    }

    // Handle posts save
    public function store() {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $stmt = $pdo->prepare("INSERT INTO modules (name) VALUES (?)");
            $stmt->execute([$name]);
            header('Location: ' . BASE_URL . '/modules');
            exit;
        }
    }

    // Delete posts
    public function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM modules WHERE id=?");
        $stmt->execute([$id]);
        header('Location: ' . BASE_URL . '/modules');
        exit;
    }

}
?>