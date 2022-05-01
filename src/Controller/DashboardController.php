<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\PartyManager;

class DashboardController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }

    public function dashboard(): string
    {
        $selectParty = new PartyManager();
        $partys = $selectParty->selectAllParty($this->user['id']);

        return $this->twig->render('Dashboard/dashboard.html.twig', [
            'partys' => $partys,
        ]);
    }
}
