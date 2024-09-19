<?php

namespace Controllers;

class UsersController extends Controller
{
    public function userManagement():void
    {
        echo $this->render('userManagement.html.twig');
    }
}
