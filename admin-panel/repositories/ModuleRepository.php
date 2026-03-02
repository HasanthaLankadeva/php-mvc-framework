<?php

class ModuleRepository
{
    public function __construct(private PDO $db) {}

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM modules ORDER BY id DESC")
            ->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM modules WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function getMainTable(int $moduleId): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, table_name
            FROM module_tables
            WHERE module_id = ? AND is_main = 1
        ");
        $stmt->execute([$moduleId]);

        return $stmt->fetch() ?: null;
    }

    public function getTables(int $moduleId): array
    {
        $stmt = $this->db->prepare("
            SELECT table_name
            FROM module_tables
            WHERE module_id = ?
        ");
        $stmt->execute([$moduleId]);

        return $stmt->fetchAll();
    }

    public function getFields(int $tableId): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM module_fields
            WHERE table_id = ?
        ");
        $stmt->execute([$tableId]);

        return $stmt->fetchAll();
    }

    public function getItems(string $table): array
    {
        $stmt = $this->db->prepare("SELECT * FROM `$table` ORDER BY id DESC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getRow(string $table, int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM `$table` WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }
}