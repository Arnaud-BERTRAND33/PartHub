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
        $error = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['participate'])) {
                $error['participate'] = 'Veuillez faire un choix';
            }

            if (!$error) {
                $participate = array_map('trim', $_POST);

                $participate['party_id'] = $_GET['party_id'];
                $participate['user_id'] = $_POST['user_id'];

                $participateManager = new GuestsManager();
                $participateManager->insertGuests($participate);
                header('Location: /party/guests?party_id=' . $partyId);
                return '';
            }

            return $this->twig->render('Guests/guests.html.twig', [
                "guests" => $guests,
                'party_id' => $partyId,
                'error' => $error,
            ]);
        }

        return $this->twig->render('Guests/guests.html.twig', [
            "guests" => $guests,
            'party_id' => $partyId,
        ]);
    }
}
//if $post value sendMail  (envoi mail)
