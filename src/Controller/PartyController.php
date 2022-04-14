<?php

namespace App\Controller;

class PartyController extends AbstractController
{
    public function party(): string
    {
        return $this->twig->render('Party/party.html.twig');
    }
}
