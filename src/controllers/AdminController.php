<?php 
namespace Controllers;

class AdminController extends Controller
{
    public function administration():void
    {
        echo $this->render('administration.html.twig');
    }
} 
