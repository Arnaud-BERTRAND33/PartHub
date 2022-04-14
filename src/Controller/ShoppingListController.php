<?php

namespace App\Controller;

class ShoppingListController extends AbstractController
{
    public function list(int $partyId): string
    {
        return $this->twig->render('List/list.html.twig');
    }
}
