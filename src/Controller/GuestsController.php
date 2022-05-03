<?php

namespace App\Controller;

use App\Model\GuestsManager;
use App\Error\LoginRequiredException;

class GuestsController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }

    public function guests(int $partyId): string
    {
        $guestManager = new GuestsManager();
        $guests = $guestManager->selectGuests();

        return $this->twig->render('Guests/guests.html.twig', [
             "guests" => $guests,
            'party_id' => $partyId,
        ]);
    }
}
