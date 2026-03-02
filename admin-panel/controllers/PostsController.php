<?php

class PostsController extends Controller
{
    private ModuleService $service;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $this->service = new ModuleService($pdo);
    }

    public function index(): void
    {
        $modules = $this->service->getAllModules();

        $this->view('posts/index', [
            'modules' => $modules,
            'active' => 'posts'
        ]);
    }

    public function module(int $id): void
    {
        try {

            $includeFile = filter_input(INPUT_GET, 'includefile') ?? null;
            $submodule   = filter_input(INPUT_GET, 'submodule') ?? null;
            $rowID       = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? null;
            $editRelation       = filter_input(INPUT_GET, 'editrel', FILTER_VALIDATE_INT) ?? null;

            $data = $this->service->getModulePageData(
                $id,
                $submodule,
                $rowID,
                $includeFile,
                $editRelation
            );

            $this->view('posts/module', [
                'modules' => $this->service->getAllModules(),
                'moduleId' => $id,
                'includeFile' => $includeFile,
                'submodule' => $submodule,
                'rowID' => $rowID,
                'active' => 'posts',
                ...$data
            ]);

        } catch (Exception $e) {
            http_response_code(404);
            echo $e->getMessage();
        }
    }
}