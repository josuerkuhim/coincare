<?php

class AuthController
{
    public function showLoginForm()
    {
        require('../app/view/auth/login.php');
    }

    public function login($request)
    {
        $username = $request['username'];
        $password = $request['password'];

        if (UserModel::validateCredentials($username, $password)) {
            $_SESSION['user'] = $username;
            header('Location: /accounts');
            exit;
        } else {
            header('Location: /login');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
