<?php
class HomeController extends Controller {

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userModel = new User();
            $user = $userModel->login(
                $_POST['username'],
                $_POST['password']
            );

            if ($user) {
                $_SESSION['user'] = $user;

                // regenerate token after login
                Csrf::regenerate();

                $this->redirect('admin/dashboard');
            }

            $this->view('login', ['error' => 'Invalid credentials']);
            return;
        }

        $this->view('login');
    }

    public function logout() {

        // Unset all session variables
        $_SESSION = [];

        // Destroy session
        session_destroy();

        // Regenerate session ID (security)
        session_start();
        session_regenerate_id(true);

        // Redirect to login
        $this->redirect('login');
    }
}
?>