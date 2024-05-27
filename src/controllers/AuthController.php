<?php

namespace Controllers;

class AuthController extends Controller
{
    public function register()
    {
        echo $this->twig->render('register.html.twig');
    }

    public function login()
    {
        echo $this->twig->render('login.html.twig');
    }
} 