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

    private function getModuleAllTables($module_id) {
        global $pdo;
        
        $stmt = $pdo->prepare("SELECT table_name FROM module_tables WHERE module_id=?");
        $stmt->execute([$module_id]);
        return $stmt->fetchAll();
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

    public function module($id) {
        global $pdo;

    // -------------------------
    // Get query parameters safely
    // -------------------------
        $moduleId       = $id ?? null;
        $includeFile    = $_GET['includefile'] ?? null;
        $submodule      = $_GET['submodule'] ?? null;
        $rowID          = $_GET['id'] ?? null;

        $modules = $this->getModules();
        $maintable = $this->getModuleTable($moduleId);
        $alltables = $this->getModuleAllTables($moduleId);

    // -------------------------
    // Whitelist allowed tables
    // -------------------------
        $allowedTables = array_column($alltables, 'table_name');

        if ($submodule && !in_array($submodule, $allowedTables, true)) {
            die("Invalid table name.");
        }
        $module_items = $this->getModuleItems($maintable['table_name']);

        // Get fields
        $stmt = $pdo->prepare("SELECT * FROM module_fields WHERE table_id=?");
        $stmt->execute([$maintable['id']]);
        $fields = $stmt->fetchAll();

        $rows = '';

        if($rowID){
            // Get rows
            $stmt = $pdo->prepare("SELECT * FROM `{$submodule}` WHERE id=?");
            $stmt->execute([$rowID]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $active = 'posts';
        $this->view('posts/module', [
            'modules' => $modules,
            'maintable' => $maintable,
            'moduleId'  => $moduleId,
            'table' => $submodule,
            'items' => $module_items,
            'includeFile' => $includeFile,
            'fields' => $fields,
            'rows' => $rows,
            'rowID' => $rowID,
            'active' => $active
        ]);
    }

    // Add / Edit posts
    /*public function module(...$params) {
        
        // params
        $module_id = (isset($params[0])) ? $params[0] : '';
        $table_name = (isset($params[1])) ? $params[1] : '';
        $params2 = (isset($params[2])) ? $params[2] : '';

        switch ($params2) {
            case 'settings':
                //Don't output, just log
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo htmlentities(
                    preg_replace('/[\r\n]+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                )
                . "<br>\n";
                break;
            case 'echo':
            default:
                
        }


        // show form according to param
        $showform = ($module_id && $table_name) ? true : false;

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
            'showform' => $showform,
            'modules' => $modules,
            //'module_name' => $modules['name'],
            'module_id'  => $module_id,
            'table' => $maintable,
            'items' => $module_items,
            'fields' => $fields,
            'active' => $active
        ]);
    }*/

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