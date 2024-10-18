<?php
namespace Middlewares;

class Admin
{
    public function __construct()
    {
        if (!$this->isAdmin()) {
            header('Location:index.php?action=login');
        }
    }

    public function isAdmin(): bool
    {
        return isset($_SESSION['user']) && ($_SESSION['user']['role'] == 1);

    }
}
