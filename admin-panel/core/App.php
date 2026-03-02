<?php

class App
{
    private PDO $pdo;
    
    public function __construct(PDO $pdo)
    {

        $this->pdo = $pdo;

        require_once CORE_PATH.'/Router.php';

        $router = new Router($this->pdo);

        require_once ROUTES_PATH.'/web.php';

        $router->dispatch();
    }
}