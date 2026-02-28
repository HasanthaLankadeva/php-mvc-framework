<?php

class App
{
    public function __construct()
    {
        require_once CORE_PATH.'/Router.php';

        $router = new Router;

        require_once ROUTES_PATH.'/web.php';

        $router->dispatch();
    }
}