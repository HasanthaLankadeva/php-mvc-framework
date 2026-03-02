<?php

class ModuleService
{
    private ModuleRepository $moduleRepo;
    private RelationRepository $relationRepo;

    public function __construct(PDO $db)
    {
        $this->moduleRepo = new ModuleRepository($db);
        $this->relationRepo = new RelationRepository($db);
    }

    public function getModulePageData(int $moduleId, ?string $submodule, ?int $rowID, ?string $include): array
    {
        $module = $this->moduleRepo->getById($moduleId);
        if (!$module) {
            throw new Exception("Module not found");
        }

        $mainTable = $this->moduleRepo->getMainTable($moduleId);
        if (!$mainTable) {
            throw new Exception("Main table not found");
        }

        $tables = $this->moduleRepo->getTables($moduleId);
        $allowedTables = array_column($tables, 'table_name');

        if ($submodule && !in_array($submodule, $allowedTables, true)) {
            throw new Exception("Invalid table");
        }

        $items = $this->moduleRepo->getItems($mainTable['table_name']);
        $fields = $this->moduleRepo->getFields($mainTable['id']);

        $row = null;
        if ($rowID && $submodule) {
            $row = $this->moduleRepo->getRow($submodule, $rowID);
        }

        $relations = [];
        if ($include === 'relations') {
            $relations = $this->relationRepo
                ->getByModuleAndTable($moduleId, $mainTable['id']);
        }

        return compact(
            'module',
            'mainTable',
            'tables',
            'items',
            'fields',
            'row',
            'relations'
        );
    }

    public function getAllModules(): array
    {
        return $this->moduleRepo->getAll();
    }
}