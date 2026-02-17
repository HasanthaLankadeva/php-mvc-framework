<?php
class SettingsController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function index() {
        $settingModel = new Setting();
        $settings = $settingModel->getAll();
        $this->view('settings', ['active' => 'settings', 'settings' => $settings]);
    }
}
?>