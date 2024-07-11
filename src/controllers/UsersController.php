<?php

namespace Controllers;

class UsersController extends Controller
{
    public function userManagement()
    {
        echo $this->render('userManagement.html.twig');
    }
} 