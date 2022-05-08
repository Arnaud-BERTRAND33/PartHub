<?php

namespace App\Controller;

use App\Error\LoginRequiredException;

class BudgetController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }
    public function budget($partyId): string
    {
        return $this->twig->render('Budget/budget.html.twig', [
            'party_id => $partyId',
        ]);
    }
}
