<?php

namespace App\Controller;

use App\Model\GuestsManager;

class GuestsController extends AbstractController
{
    public function guests(): string
    {
        $guestManager = new GuestsManager();
        $guests = $guestManager->selectGuests();

//       var_dump($guests);die;

        return $this->twig->render('Guests/guests.html.twig', ["guests" => $guests]);
    }
}
