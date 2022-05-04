<?php

namespace App\Controller;

use App\Model\GuestsManager;
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

        $guestManager = new GuestsManager();
        $guests = $guestManager->selectGuests($partyId);

        return $this->twig->render('Guests/guests.html.twig', [
            "guests" => $guests,
            'party_id' => $partyId,
        ]);
    }

    public function participate(): string
    {
        $participateManager = new GuestsManager();
        $participates = $participateManager->selectGuests();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $participate = array_map($_POST);

            $participate['party_id'] = $_GET['party_id'];
            $participate['user_id'] = $this->user['id'];

            $participatesManager = new GuestsManager();
            $participatesManager->insert($user_has_party);
            header('Location: /party/comments?party_id=' . $partyId);
            return '';
        }
        return $this->twig->render('Guests/guests.html.twig', [
            'participates' => $participates,
        ]);
    }
//            return $this->twig->render('Guests/guests.html.twig', [
//                'participates' => $participates,
//                'party_id' => $partyId,
//        ]);
}


