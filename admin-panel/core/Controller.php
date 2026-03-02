<?php
class Controller 
{

    protected PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    protected function view(string $view, array $data = []): void 
    {
        extract($data);

        require VIEW_PATH . '/template/header.php';
        require VIEW_PATH . '/' . $view . '.php';
        require VIEW_PATH . '/template/footer.php';
    }

    protected function redirect($path) {
        header('Location: ' . BASE_URL . '/' . ltrim($path, '/'));
        exit;
    }
    
}
?>