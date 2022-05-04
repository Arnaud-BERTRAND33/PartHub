<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\CommentsManager;
use App\Model\PartyManager;
use App\Model\UserManager;

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

        $userManager = new UserManager();
        $totalUsers = count($userManager->selectAll());

        $commentManager = new CommentsManager();
        $comments = $commentManager->selectByPartyId($partyId);

        return $this->twig->render('PartyDashboard/partyDashboard.html.twig', [
            'party_id' => $partyId,
            'party' => $party,
            'totalUsers' => $totalUsers,
            'comments' => $comments,
        ]);
    }
}
