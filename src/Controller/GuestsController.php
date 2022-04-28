<?php

namespace App\Controller;

class GuestsController extends AbstractController
{
    public function guests(): string
    {
        return $this->twig->render('Guests/guests.html.twig');
    }






}
