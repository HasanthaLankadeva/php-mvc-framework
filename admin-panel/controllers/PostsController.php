<?php
class PostsController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    private function getModules() {
        global $pdo;
        
        $stmt = $pdo->query("SELECT * FROM modules ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    private function getModuleTable($module_id) {
        global $pdo;
        
        $stmt = $pdo->prepare("SELECT id, table_name FROM module_tables WHERE module_id=? AND is_main=?");
        $stmt->execute([$module_id, '1']);
        return $stmt->fetch();
    }

     private function getModuleItems($table_name) {
        global $pdo;
        
        $stmt = $pdo->query("SELECT * FROM `$table_name` ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // List all posts
    public function index() {
        $modules = $this->getModules();
        
        $active = 'posts';
        $this->view('posts/index', [
            'modules' => $modules, 
            'active' => $active
        ]);
    }

    // Add / Edit posts
    public function module(...$params) {
        
        $module_id = (isset($params[0])) ? $params[0] : '';
        $item_id = (isset($params[2])) ? $params[2] : '';

        $modules = $this->getModules();
        $maintable = $this->getModuleTable($module_id);
        $module_items = $this->getModuleItems($maintable['table_name']);

    

        global $pdo;

        // Get fields
        $stmt = $pdo->prepare("SELECT * FROM module_fields WHERE table_id=?");
        $stmt->execute([$maintable['id']]);
        $fields = $stmt->fetchAll();

        $active = 'posts';
        $this->view('posts/module', [
            'modules' => $modules,
            //'module_name' => $modules['name'],
            'module_id'  => $module_id,
            'table' => $maintable,
            'items' => $module_items,
            'fields' => $fields,
            'active' => $active
        ]);
    }

    // Show add posts
    /*public function create() {
        $active = 'posts';
        $this->view('posts/create', ['active' => $active]);
    }*/

    // Handle posts edit
    /*public function edit() {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $stmt = $pdo->prepare("INSERT INTO modules (name) VALUES (?)");
            $stmt->execute([$name]);
            header('Location: ' . BASE_URL . '/modules');
            exit;
        }
    }*/

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