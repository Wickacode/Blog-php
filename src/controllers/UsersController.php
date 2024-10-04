<?php

namespace Controllers;

class UsersController extends Controller
{
    public function userManagement(): void
    {
        $this->render('userManagement.html.twig');
    }
}
