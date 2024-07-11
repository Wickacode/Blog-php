<?php

namespace Controllers;

class HomeController extends Controller
{
    public function index()
    {
      echo $this->render('home.html.twig');
    }
} 