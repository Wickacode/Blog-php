<?php 
namespace Controllers;

class AdminController extends Controller
{
    public function administration()
    {
        echo $this->twig->render('administration.html.twig');
    }
} 
