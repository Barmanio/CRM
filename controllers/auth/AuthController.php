<?php

namespace controllers\auth;

use models\AuthUser;


class AuthController{


    public function register()
    {
        include 'app/views/users/register.php';

    }
    public function store()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $username = trim(htmlspecialchars($_POST['username']));
            $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if (empty($username) || empty($email) || empty($password) || empty($confirm_password) ){
                echo "Все поля должны быть заполнены";
                return;
            }
            if ($password !== $confirm_password) {
                echo "Пароль не подходит";
                return;
            }
            $userModel = new AuthUser();
            $userModel->register($username,$email, $password);
        }
        header("Location: /auth/login");
    }
    public function login()
    {
        include 'app/views/users/login.php';

    }

    public function authenticate(){
        $authModel = new AuthUser();

        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $remember = isset($_POST['remember']) ? $_POST['remember'] : '';


            $user = $authModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])){
                if (session_status() === PHP_SESSION_NONE) {
					session_start();
				}
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_email'] = $user['email'];

                if($remember == 'on'){
                    setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), '/');
                    setcookie('password', $password, time() + (7 * 24 * 60 * 60), '/');
                }

                header("Location: /");
            }else{
                echo "invalid email or password";
            }
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
        session_unset();
        session_destroy();
        header("Location: /");

    }
}