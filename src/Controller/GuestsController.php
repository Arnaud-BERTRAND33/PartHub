<?php

namespace App\Controller;

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
        return $this->twig->render('Guests/guests.html.twig', [
            'party_id' => $partyId,
        ]);
    }
}
