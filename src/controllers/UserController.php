<?php

namespace Controllers;

class UserController extends Controller
{
    public function userManagement()
    {
        echo $this->twig->render('userManagement.html.twig');
    }
} 