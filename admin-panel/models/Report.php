<?php
class Report {
    public function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, name, date FROM reports");
        return $stmt->fetchAll();
    }
}
?>