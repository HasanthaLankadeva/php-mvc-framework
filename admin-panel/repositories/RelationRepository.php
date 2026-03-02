<?php

class RelationRepository
{
    public function __construct(private PDO $db) {}

    public function getByModuleAndTable(int $moduleId, int $tableId): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM relations_meta
            WHERE moduleID = ? AND tableID = ?
        ");
        $stmt->execute([$moduleId, $tableId]);

        return $stmt->fetchAll();
    }
}