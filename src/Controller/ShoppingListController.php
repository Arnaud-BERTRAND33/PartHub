<?php

namespace App\Controller;

use App\Error\LoginRequiredException;

class ShoppingListController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }
    public function list(int $partyId): string
    {
        return $this->twig->render('List/list.html.twig', [
            'party_id' => $partyId,
        ]);
    }
}
