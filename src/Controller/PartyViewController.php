<?php

namespace App\Controller;

use App\Error\LoginRequiredException;

class PartyViewController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }

    /** Remettre (int $partyId) après avoir réalisé requête */
    public function view(int $partyId): string
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $uploadDir = '../upload/';
            $uploadFile = $uploadDir . basename($_FILES['picture']['name']);
            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            $authorizedExtensions = ['jpg', 'jpeg', 'png'];
            $maxFileSize = 5000000;

            if ((!in_array($extension, $authorizedExtensions))) {
                return 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
            }

            if (
                file_exists($_FILES['picture']['tmp_name'])
                && filesize($_FILES['picture']['tmp_name']) > $maxFileSize
            ) {
                return "Votre fichier doit faire moins de 2M !";
            }
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);
        }

        return $this->twig->render('PartyView/partyView.html.twig', [
            'party_id' => $partyId,
        ]);
    }
}
