<?php

namespace App\src\controllers;

class Home extends AbstractController
{
    public function index()
    {
        $this->render('home');
    }
} 