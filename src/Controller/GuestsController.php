<?php

namespace App\Controller;

use App\Model\GuestsManager;

class GuestsController extends AbstractController
{
    public function guests(): string
    {
        $guests = new GuestsManager();
        $guests->selectGuests();

//        var_dump($guests);

        return $this->twig->render('Guests/guests.html.twig');
    }
}
