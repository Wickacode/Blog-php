<?php

namespace Controllers;

class HomeController extends Controller
{
    public function index():void
    {
      echo $this->render('home.html.twig');
    }
} 
