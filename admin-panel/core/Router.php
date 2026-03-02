<?php

class Router
{
    private PDO $pdo;

    private array $routes = [];
    private array $middleware = [];
    private $groupPrefix = '';
    private $groupMiddleware = [];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get($uri, $action, $middleware = [])
    {
        $this->addRoute('GET', $uri, $action, $middleware);
    }

    public function post($uri, $action, $middleware = [])
    {
        $this->addRoute('POST', $uri, $action, $middleware);
    }

    public function put($uri, $action, $middleware = [])
    {
        $this->addRoute('PUT', $uri, $action, $middleware);
    }

    public function delete($uri, $action, $middleware = [])
    {
        $this->addRoute('DELETE', $uri, $action, $middleware);
    }

    private function addRoute($method, $uri, $action, $middleware)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => trim($this->groupPrefix . '/' . trim($uri, '/'), '/'),
            'action' => $action,
            'middleware' => array_merge($this->groupMiddleware, $middleware)
        ];
    }

    public function dispatch()
    {
        $requestUri = trim($_GET['url'] ?? '', '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {

            if ($route['method'] !== $requestMethod) continue;

            $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $route['uri']);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $requestUri, $matches)) {

                array_shift($matches);

                // Run middleware
                foreach ($route['middleware'] as $mw) {
                    (new $mw)->handle();
                }

                return $this->execute($route['action'], $matches);
            }
        }

        $this->abort404();
    }

    private function execute($action, $params)
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }

        if (is_string($action)) {

            [$controller, $method] = explode('@', $action);

            if (!class_exists($controller)) {
                throw new Exception("Controller $controller not found");
            }

            // Inject PDO here
            $controllerInstance = new $controller($this->pdo);

            if (!method_exists($controllerInstance, $method)) {
                throw new Exception("Method $method not found in $controller");
            }

            return call_user_func_array([$controllerInstance, $method], $params);
        }
    }

    public function group($options, $callback)
    {
        $previousPrefix = $this->groupPrefix;
        $previousMiddleware = $this->groupMiddleware;

        if (isset($options['prefix'])) {
            $this->groupPrefix .= '/' . trim($options['prefix'], '/');
        }

        if (isset($options['middleware'])) {
            $this->groupMiddleware = array_merge(
                $this->groupMiddleware,
                $options['middleware']
            );
        }

        $callback($this);

        $this->groupPrefix = $previousPrefix;
        $this->groupMiddleware = $previousMiddleware;
    }

    private function abort404()
    {
        http_response_code(404);
        die("404 Not Found");
    }
}