<?php

namespace App\Controller;

class ListController extends AbstractController
{
    public function list(): string
    {
        return $this->twig->render('List/list.html.twig');
    }
}
