<?php
class Controller {

    protected function view($view, $data = []) {
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