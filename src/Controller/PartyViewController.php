<?php

namespace App\Controller;

class PartyViewController extends AbstractController
{
    public function view(): string
    {
        return $this->twig->render('PartyView/partyView.html.twig');
    }
}
