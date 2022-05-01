<?php

namespace App\Controller;

use App\Error\LoginRequiredException;

class PartyDashboardController extends AbstractController
{
    private int $partyId = 1;

    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }
    public function dashboard(int $partyId): string
    {
        return $this->twig->render('PartyDashboard/partyDashboard.html.twig', [
        'party_id' => $partyId,
            ]);
    }
}
