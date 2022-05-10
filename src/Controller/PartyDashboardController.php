<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\AlcoolManager;
use App\Model\CommentsManager;
use App\Model\FoodManager;
use App\Model\GuestsManager;
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

        $guestManager = new GuestsManager();
        $totalUsers = count($guestManager->participateGuests($partyId));

        $commentManager = new CommentsManager();
        $comments = $commentManager->selectByPartyId($partyId);

        $alcoolManager = new  AlcoolManager();
        $alcools = $alcoolManager->selectAllByPartyId($partyId);

        $foodManager = new  FoodManager();
        $foods = $foodManager->selectAllByPartyId($partyId);

        return $this->twig->render('PartyDashboard/partyDashboard.html.twig', [
            'party_id' => $partyId,
            'party' => $party,
            'totalUsers' => $totalUsers,
            'comments' => $comments,
            'alcools' => $alcools,
            'foods' => $foods,
        ]);
    }
}
