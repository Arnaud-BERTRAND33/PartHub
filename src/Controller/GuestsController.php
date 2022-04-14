<?php

namespace App\Controller;

class GuestsController extends AbstractController
{
    public function guests(int $partyId): string
    {
        return $this->twig->render('Guests/guests.html.twig');
    }
}
