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
        $selectParty = new PartyManager();
        $party = $selectParty->selectOneById($partyId);

        return $this->twig->render('PartyDashboard/partyDashboard.html.twig', [
            'party_id' => $partyId,
            'party' => $party,
        ]);
    }
}
