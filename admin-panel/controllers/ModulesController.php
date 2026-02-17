<?php
class ModulesController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // List all modules
    public function index() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM modules ORDER BY id DESC");
        $modules = $stmt->fetchAll();
        $active = 'modules';
        $this->view('modules/index', ['modules' => $modules, 'active' => $active]);
    }

    // Show add module form
    public function create() {
        $active = 'modules';
        $this->view('modules/create', ['active' => $active]);
    }

    // Handle module creation
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

    // Delete module
    public function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM modules WHERE id=?");
        $stmt->execute([$id]);
        header('Location: ' . BASE_URL . '/modules');
        exit;
    }

    // Module table creation page
    public function tables($module_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM module_tables WHERE module_id=?");
        $stmt->execute([$module_id]);
        $tables = $stmt->fetchAll();

        $stmt = $pdo->prepare("SELECT * FROM modules WHERE id=?");
        $stmt->execute([$module_id]);
        $module = $stmt->fetch();

        $active = 'modules';
        $this->view('modules/tables', [
            'module' => $module,
            'tables' => $tables,
            'active' => $active
        ]);
    }

    // Add table inside module
    public function addTable($module_id) {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $table_name = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['table_name']);
            $isMain = isset($_POST['is_main']) ? 1 : 0;

            // Unset previous main table
            if ($isMain) {
                $stmt = $pdo->prepare(
                    "UPDATE module_tables SET is_main = 0 WHERE module_id = ?"
                );
                $stmt->execute([$module_id]);
            }

            // Save table metadata
            $stmt = $pdo->prepare("INSERT INTO module_tables (module_id, table_name, is_main) VALUES (?,?,?)");
            $stmt->execute([$module_id, $table_name, $isMain]);
            $table_id = $pdo->lastInsertId();

            // Create physical MySQL table
            $pdo->exec("
                CREATE TABLE `$table_name` (
                    id INT AUTO_INCREMENT PRIMARY KEY
                ) ENGINE=InnoDB
            ");

            // Insert ID field into module_fields
            $pdo->prepare("
                INSERT INTO module_fields
                (table_id, field_name, field_type, is_system)
                VALUES (?, 'id', 'INT', 1)
            ")->execute([$table_id]);

            // Create default fields (DB + metadata)
            foreach (DEFAULT_TABLE_FIELDS as $name => $cfg) {

                // Build SQL
                $sql = "ALTER TABLE `$table_name`
                        ADD `$name` {$cfg['type']}";

                if (!$cfg['nullable']) {
                    $sql .= " NOT NULL";
                }

                if (!empty($cfg['default'])) {
                    $sql .= " DEFAULT {$cfg['default']}";
                }

                $pdo->exec($sql);

                // Register in module_fields
                $stmt = $pdo->prepare("
                    INSERT INTO module_fields
                    (table_id, field_name, field_type, is_system)
                    VALUES (?, ?, ?, 1)
                ");
                $stmt->execute([
                    $table_id,
                    $name,
                    $cfg['type']
                ]);
            }

            header('Location: ' . BASE_URL . '/modules/tables/' . $module_id);
            exit;
        }
    }

    // Delete table inside module
    public function deleteTable($table_id) {
        global $pdo;

        // Get table info
        $stmt = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();

        if (!$table) {
            die("Table not found");
        }

        $table_name = $table['table_name'];
        $module_id = $table['module_id'];

        try {
            // 1️⃣ Drop the actual MySQL table
            $pdo->exec("DROP TABLE IF EXISTS `$table_name`");

            // 2️⃣ Delete the table record in module_tables (module_fields have ON DELETE CASCADE)
            $stmt = $pdo->prepare("DELETE FROM module_tables WHERE id=?");
            $stmt->execute([$table_id]);

            // Redirect back to module tables page
            header('Location: ' . BASE_URL . '/modules/tables/' . $module_id);
            exit;

        } catch (PDOException $e) {
            die("Error deleting table: " . $e->getMessage());
        }
    }

    // Show table rows
    public function rows($table_id) {
        global $pdo;

        // Get table info
        $stmt = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();

        // Get fields
        $stmt = $pdo->prepare("SELECT * FROM module_fields WHERE table_id=?");
        $stmt->execute([$table_id]);
        $fields = $stmt->fetchAll();

        // Get rows
        $stmt = $pdo->query("SELECT * FROM `{$table['table_name']}`");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $active = 'modules';
        $this->view('modules/rows', [
            'table' => $table,
            'fields' => $fields,
            'rows' => $rows,
            'active' => $active
        ]);
    }

    // Add a row (AJAX POST)
    public function addRow($table_id) {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("SELECT table_name FROM module_tables WHERE id=?");
            $stmt->execute([$table_id]);
            $table = $stmt->fetch();
            $table_name = $table['table_name'];

            $columns = array_keys($_POST['data']);
            $placeholders = implode(',', array_fill(0, count($columns), '?'));
            $sql = "INSERT INTO `$table_name` (`".implode('`,`',$columns)."`) VALUES ($placeholders)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($_POST['data']));

            echo json_encode(['success'=>true]);
            exit; // ensure nothing else is output
        }
    }

    // Delete a row (AJAX POST)
    public function deleteRow($table_id, $row_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT table_name FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();
        $table_name = $table['table_name'];

        $stmt = $pdo->prepare("DELETE FROM `$table_name` WHERE id=?");
        $stmt->execute([$row_id]);

        echo json_encode(['success'=>true]);
        exit; // ensure nothing else is output
    }

    // Update a row (AJAX POST)
    public function updateRow($table_id, $row_id) {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("SELECT table_name FROM module_tables WHERE id=?");
            $stmt->execute([$table_id]);
            $table = $stmt->fetch();
            $table_name = $table['table_name'];

            $set = [];
            $values = [];
            foreach ($_POST['data'] as $col => $val) {
                $set[] = "`$col`=?";
                $values[] = $val;
            }
            $values[] = $row_id;

            $sql = "UPDATE `$table_name` SET ".implode(',',$set)." WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            echo json_encode(['success'=>true]);
            exit; // ensure nothing else is output
        }
    }

    public function fields($table_id) {
        global $pdo;

        // Get table
        $stmt = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();

        if (!$table) {
            die('Table not found');
        }

        // Get fields
        $stmt = $pdo->prepare("SELECT * FROM module_fields WHERE table_id=?");
        $stmt->execute([$table_id]);
        $fields = $stmt->fetchAll();

        $this->view('modules/fields', [
            'table'  => $table,
            'fields' => $fields,
            'active' => 'modules'
        ]);
    }
    
    public function addField($table_id) {
        global $pdo;

        if (!Csrf::validate($_POST[CSRF_TOKEN_NAME] ?? '')) {
            echo json_encode(['success'=>false,'error'=>'Invalid CSRF token']);
            exit;
        }

        $name   = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['field_name']);
        $type   = strtoupper($_POST['field_type']);
        $length = $_POST['field_length'] ?: null;
        $sqlType = $this->sqlType($type);

        if (!$name || !$type) {
            echo json_encode(['success'=>false,'error'=>'Invalid input']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT table_name FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();

        if (!$table) {
            echo json_encode(['success'=>false,'error'=>'Table not found']);
            exit;
        }

        //$sqlType = $length ? "$type($length)" : $type;

        try {
            // ALTER TABLE
            $pdo->exec("ALTER TABLE `{$table['table_name']}` ADD `$name` $sqlType NULL");

            // Save metadata
            $stmt = $pdo->prepare("
                INSERT INTO module_fields (table_id, field_name, field_type, field_length)
                VALUES (?,?,?,?)
            ");
            $stmt->execute([$table_id, $name, $type, $length]);

            echo json_encode(['success'=>true]);
            exit;

        } catch (PDOException $e) {
            echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
            exit;
        }
    }

    public function deleteField($field_id) {
        global $pdo;

        /*if (!Csrf::validate($_POST[CSRF_TOKEN_NAME] ?? '')) {
            echo json_encode(['success'=>false,'error'=>'Invalid CSRF token']);
            exit;
        }*/

        $stmt = $pdo->prepare("
            SELECT mf.field_name, mt.table_name
            FROM module_fields mf
            JOIN module_tables mt ON mt.id = mf.table_id
            WHERE mf.id=?
        ");
        $stmt->execute([$field_id]);
        $field = $stmt->fetch();

        if (!$field) {
            echo json_encode(['success'=>false,'error'=>'Field not found']);
            exit;
        }

        try {
            $pdo->exec("ALTER TABLE `{$field['table_name']}` DROP `{$field['field_name']}`");
            $pdo->prepare("DELETE FROM module_fields WHERE id=?")->execute([$field_id]);

            echo json_encode(['success'=>true]);
            exit;

        } catch (PDOException $e) {
            echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
            exit;
        }
    }

    // add / edit row item
    public function rowForm($tableId, $rowId = null) {
        global $pdo;

        // Table info
        $table = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $table->execute([$tableId]);
        $table = $table->fetch();

        if (!$table) die('Table not found');

        $physicalTable = $table['table_name'];

        // Load fields (exclude system-only like created_at)
        $fields = $pdo->prepare("
            SELECT * FROM module_fields
            WHERE table_id = ?
            ORDER BY id ASC
        ");
        $fields->execute([$tableId]);
        $fields = $fields->fetchAll();

        $row = [];

        // Editing existing row
        if ($rowId) {
            $stmt = $pdo->prepare("SELECT * FROM `$physicalTable` WHERE id=?");
            $stmt->execute([$rowId]);
            $row = $stmt->fetch();
        }

        $this->view('modules/row_form', [
            'table'  => $table,
            'fields' => $fields,
            'row'    => $row, 
            'active' => 'modules'
        ]);
        //require VIEW_PATH . '/modules/row_form.php';
    }

    // save row data
    public function saveRow($tableId, $rowId = null) {
        global $pdo;

        //Csrf::verify();

        $table = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $table->execute([$tableId]);
        $table = $table->fetch();

        $physicalTable = $table['table_name'];

        $fields = $pdo->prepare("
            SELECT * FROM module_fields
            WHERE table_id = ? AND field_name NOT IN ('id','created_at')
        ");
        $fields->execute([$tableId]);
        $fields = $fields->fetchAll();

        // Build data array safely
        $data = [];

        foreach ($fields as $f) {
            $name = $f['field_name'];

            if (in_array($name, ['id', 'created_at'])) {
                continue;
            }

            // Handle file/image separately
            if (in_array($f['field_name'], ['file', 'image'])) {
                if (
                    isset($_FILES[$name]) &&
                    $_FILES[$name]['error'] === UPLOAD_ERR_OK
                ) {

                    $dir = PUBLIC_PATH . '/uploads/modules/' . $tableId;
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    $ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
                    $fileName = uniqid() . '.' . $ext;

                    move_uploaded_file(
                        $_FILES[$name]['tmp_name'],
                        $dir . '/' . $fileName
                    );

                    $data[$name] = 'uploads/modules/' . $tableId . '/' . $fileName;
                }
                // DO NOT set NULL if no upload
                continue;
            }

            // Normal fields
            if (isset($_POST[$name])) {
                $data[$name] = $_POST[$name];
            }
        }

        if (empty($data)) {
            header("Location: " . BASE_URL . "/modules/rows/" . $tableId);
            exit;
        }

        
        if (!empty($rowId)) {
            
            // Update
            $set = [];
            $values = [];

            foreach ($data as $k => $v) {
                $set[] = "`$k` = ?";
                $values[] = $v;
            }

            $values[] = $rowId;

            $sql = "UPDATE `$physicalTable`
                    SET " . implode(', ', $set) . "
                    WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);
        } else {
            // INSERT
            $cols = implode(', ', array_keys($data));
            $qs   = implode(', ', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO `$physicalTable` ($cols)
                    VALUES ($qs)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($data));
        }

        header("Location: " . BASE_URL . "/modules/rows/" . $tableId);
        exit;
    }

    private function sqlType(string $type): string
    {
        return match ($type) {
            'NUMBER'    => 'INT',
            'DATE'      => 'DATE',
            'TEXTAREA'  => 'TEXT',
            'FILE'      => 'VARCHAR(500)',
            'IMAGE'     => 'VARCHAR(500)',
            default     => 'VARCHAR(255)'
        };
    }

    public function relations(...$params)
    {
        global $pdo;
        
        $module_id = $params[0];
        $table_id = $params[1];

        // Get table
        $stmt = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();

        if (!$table) {
            die('Table not found');
        }

        // Get relations
        $stmt = $pdo->prepare("SELECT * FROM relations_meta WHERE moduleID=? AND tableID=?");
        $stmt->execute([$module_id, $table_id]);
        $relations = $stmt->fetchAll();

        $this->view('modules/relations', [
            'module_id'  => $module_id,
            'table'  => $table,
            'relations' => $relations,
            'active' => 'modules'
        ]);
    }

     public function addrelations(...$params)
    {
        global $pdo;
        
        $module_id = $params[0];
        $table_id = $params[1];

        // Get table
        $stmt = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $stmt->execute([$table_id]);
        $table = $stmt->fetch();

        if (!$table) {
            die('Table not found');
        }

        // Get fields
        $stmt = $pdo->prepare("SELECT * FROM module_fields WHERE table_id=?");
        $stmt->execute([$table_id]);
        $fields = $stmt->fetchAll();

        // Get tables
        $stmt = $pdo->query("SELECT name, id FROM modules ORDER BY id DESC");
        $moduletables = $stmt->fetchAll();

        $alltables = [];

        foreach ($moduletables as $moduletable) {

            $stmt = $pdo->prepare("SELECT table_name FROM module_tables WHERE module_id=?");
            $stmt->execute([$moduletable['id']]);
            $childtables = $stmt->fetchAll();

            foreach ($childtables as $childtable) {

                if (in_array($childtable['table_name'], $alltables)) {
                    continue;
                }

                $alltables[] = [
                    'module'  => $moduletable['name'],
                    'table'  => $childtable['table_name']
                ];

            }
        }

        $this->view('modules/addrelations', [
            'module_id'  => $module_id,
            'table'  => $table,
            'fields' => $fields,
            'alltables' => $alltables,
            'active' => 'modules'
        ]);
    }
    
     public function saverelation(...$params)
    {
        global $pdo;

        if (!Csrf::validate($_POST[CSRF_TOKEN_NAME] ?? '')) {
            echo json_encode(['success'=>false,'error'=>'Invalid CSRF token']);
            exit;
        }
        
        $module_id = $params[0];
        $table_id = $params[1];

        $relationname = $_POST['relationname'] ?: null;
        $moduleID = $_POST['module_id'];
        $tableID = $_POST['table_id'];
        $currenttablefield = $_POST['current_table_field'];
        $childtable = $_POST['child_table'];
        $childfield = $_POST['child_field'];

       try {
            // Save relations
            $stmt = $pdo->prepare("
                INSERT INTO relations_meta (relationname, moduleID, tableID, currenttablefield, childtable, childfield)
                VALUES (?,?,?,?,?,?)
            ");
            $stmt->execute([$relationname, $moduleID, $tableID, $currenttablefield, $childtable, $childfield]);

            echo json_encode(['success'=>true]);
            exit;

        } catch (PDOException $e) {
            echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
            exit;
        }

        $this->view('modules/relations', [
            'module_id'  => $module_id,
            'table'  => $table,
            'fields' => $fields,
            'alltables' => $alltables,
            'active' => 'modules'
        ]);
    }
}
?>