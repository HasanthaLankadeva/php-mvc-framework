<?php

class QueryBuilder
{
    protected PDO $db;
    protected string $table;

    public function __construct(string $table)
    {
        $this->db = Database::connect();
        $this->table = $table;
    }

    /**
     * Get all records
     */
    public function all(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY id DESC"
        );

        return $stmt->fetchAll();
    }

    /**
     * Find record by ID
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Insert record
     */
    public function insert(array $data): bool
    {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(',:', array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Simple where (optional helper)
     */
    public function where(string $column, $value): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$column} = :value"
        );

        $stmt->execute(['value' => $value]);

        return $stmt->fetchAll();
    }
	
	/**
     * Simple Update (optional helper)
     */
	public function update(int $id, array $data): bool
    {
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $data['id'] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
	
	/**
     * Simple Delete (optional helper)
     */
	public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
?>