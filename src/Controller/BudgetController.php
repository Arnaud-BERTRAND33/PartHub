<?php

namespace App\Controller;

class BudgetController extends AbstractController
{
    public function budget(int $partyId): string
    {
        return $this->twig->render('Budget/budget.html.twig');
    }
}
