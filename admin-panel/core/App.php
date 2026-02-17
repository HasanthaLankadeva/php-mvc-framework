<?php
class App {

    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        $url = $this->parseUrl();

        // Default controller & method
        $controllerName = ucfirst($url[0] ?? 'home') . 'Controller';
        //$method = $url[1] ?? 'index';
        $method = empty($url[0]) ? 'login' : ($url[1] ?? 'index');
        $params = array_slice($url, 2);

        // Force HomeController for login/logout
        if (in_array(strtolower($method), ['login', 'logout']) || in_array(strtolower($url[0] ?? ''), ['login', 'logout'])) {
            $controllerName = 'HomeController';
            $method = strtolower($url[0] ?? 'login'); // use login/logout as method
            $params = [];
        }

        // Check if controller class exists
        if (!class_exists($controllerName)) {
            die("Controller $controllerName does not exist");
        }

        // Instantiate controller
        $this->controller = new $controllerName;

        // Check if method exists
        if (!method_exists($this->controller, $method)) {
            die("Method $method does not exist in $controllerName");
        }

        $this->method = $method;
        $this->params = $params;

        // Call the controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', trim($_GET['url'], '/'));
        }
        return [];
    }
}
?>