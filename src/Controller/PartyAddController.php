<?php

namespace App\Controller;

class PartyAddController extends AbstractController
{
    public function add(): string
    {
        return $this->twig->render('PartyAdd/partyAdd.html.twig');
    }
}
