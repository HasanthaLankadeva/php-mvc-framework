<?php
class Setting {
    public function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, name, value FROM settings");
        return $stmt->fetchAll();
    }
}
?>