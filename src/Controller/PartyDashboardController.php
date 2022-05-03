<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\PartyManager;

class PartyDashboardController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }
    public function partyDashboard(int $partyId): string
    {
        $partyManager = new PartyManager();
        $party = $partyManager->selectOneById($partyId);

        return $this->twig->render('PartyDashboard/partyDashboard.html.twig', [
            'party' => $party,
            'party_id' => $partyId,
        ]);
    }
}
