<?php

namespace Controllers;

class HomeController extends Controller
{
  public function index(): void
  {
    $this->render('home.html.twig');
  }
}
