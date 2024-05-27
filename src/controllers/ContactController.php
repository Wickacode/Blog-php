<?php

namespace Controllers;

class ContactController extends Controller
{
    public function contact()
    {
        echo $this->twig->render('contact.html.twig');
    }
} 