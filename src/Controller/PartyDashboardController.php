<?php

namespace App\Controller;

class PartyDashboardController extends AbstractController
{
    public function dashboard(int $partyId): string
    {
        return $this->twig->render('PartyDashboard/partyDashboard.html.twig');
    }
}
