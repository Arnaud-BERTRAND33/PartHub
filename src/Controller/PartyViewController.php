<?php

namespace App\Controller;

class PartyViewController extends AbstractController
{
    public function view(int $partyId): string
    {
        return $this->twig->render('PartyView/partyView.html.twig');
    }
}
