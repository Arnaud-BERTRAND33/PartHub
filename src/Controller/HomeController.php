<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Home/index.html.twig');
    }


    public function contact(): string
    {
        return $this->twig->render('Home/contact.html.twig');
    }
}
