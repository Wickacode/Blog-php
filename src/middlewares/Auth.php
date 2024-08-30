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

    public function isAuth(): bool
    {
        return isset($_SESSION['user']);

    }
}