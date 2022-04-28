<?php

namespace App\Controller;

class PartyDashboardController extends AbstractController
{
    public function dashboard(): string
    {
        return $this->twig->render('PartyDashboard/partyDashboard.html.twig');
    }
}
