<?php
class Breadcrumb {

    public static function render() {
        global $pdo;

        $url = $_GET['url'] ?? '';
        $parts = explode('/', trim($url, '/'));

        if (!$parts[0]) {
            self::output($items);
            return;
        }

        if ($parts[0] === 'modules') {
            $items[] = ['label' => 'Modules', 'url' => BASE_URL . '/modules'];

            // /modules/tables/{module_id}
            if (($parts[1] ?? '') === 'tables' && isset($parts[2])) {
                $module = self::module($parts[2]);
                if ($module) {
                    $items[] = ['label' => $module['name']];
                }
            }

            // /modules/fields/{table_id}
            if (($parts[1] ?? '') === 'fields' && isset($parts[2])) {
                $table = self::table($parts[2]);
                if ($table) {
                    $module = self::module($table['module_id']);
                    $items[] = ['label' => $module['name'], 'url'=>BASE_URL.'/modules/tables/'.$module['id']];
                    $items[] = ['label' => 'Manage Fields'];
                }
            }

            // /modules/rows/{table_id}
            if (($parts[1] ?? '') === 'rows' && isset($parts[2])) {
                $table = self::table($parts[2]);
                if ($table) {
                    $module = self::module($table['module_id']);
                    $items[] = ['label' => $module['name'], 'url'=>BASE_URL.'/modules/tables/'.$module['id']];
                    $items[] = ['label' => 'Manage Rows'];
                }
            }

            // /modules/rowForm/{table_id}/{row_id}
            if (($parts[1] ?? '') === 'rowForm' && isset($parts[2]) && isset($parts[3])) {
                $table = self::table($parts[2]);
                if ($table) {
                    $module = self::module($table['module_id']);
                    $items[] = ['label' => $module['name'], 'url'=>BASE_URL.'/modules/tables/'.$module['id']];
                    $items[] = ['label' => 'Manage Rows', 'url'=>BASE_URL.'/modules/rows/'.$table['id']];
                    $items[] = ['label' => 'Edit Rows'];
                }
            }

            // /modules/relations/{module_id}/{table_id}
            if (($parts[1] ?? '') === 'relations' && isset($parts[2]) && isset($parts[3])) {
                $module = self::module($parts[2]);
                if ($module) {
                    $items[] = ['label' => $module['name'], 'url'=>BASE_URL.'/modules/tables/'.$module['id']];
                    $items[] = ['label' => 'Relations'];
                }
            }
        }

        self::output($items);
    }

    private static function module($id) {
        global $pdo;
        $s = $pdo->prepare("SELECT * FROM modules WHERE id=?");
        $s->execute([$id]);
        return $s->fetch();
    }

    private static function table($id) {
        global $pdo;
        $s = $pdo->prepare("SELECT * FROM module_tables WHERE id=?");
        $s->execute([$id]);
        return $s->fetch();
    }

    private static function output($items) {
        require VIEW_PATH . '/template/breadcrumb.php';
    }
}