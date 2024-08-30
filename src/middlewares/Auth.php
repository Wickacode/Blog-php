<?php
namespace Middlewares;

class Auth
{
    public function __construct()
    {
        if (!$this->isAuth()) {
            header('Location:index.php?action=login');
            exit;
        }
    }

    public function isAuth()
    {
        return isset($_SESSION['user']);

    }
}