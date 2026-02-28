<?php
class HomeController extends Controller {

    public function login()
    {
        $this->view('login');
    }

    public function loginPost()
    {
        $userModel = new User();

        $user = $userModel->login(
            $_POST['username'],
            $_POST['password']
        );

        if ($user) {
            $_SESSION['user'] = $user;
            Csrf::regenerate();
            $this->redirect('admin/dashboard');
        }

        $this->view('login', ['error' => 'Invalid credentials']);
    }

}
?>