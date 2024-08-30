<?php

namespace Controllers;

class ContactController extends Controller
{
    public function contact():void
    {
        echo $this->render('contact.html.twig');
    }
} 