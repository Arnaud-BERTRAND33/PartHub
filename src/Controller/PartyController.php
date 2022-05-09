<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\PartyManager;

class PartyController extends AbstractController
{
    public function add(): string
    {
        /** Sécurisation formulaire partyadd + ajout dans BDD */
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $tmpName = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $size = $_FILES['picture']['size'];
            $extensions = ['jpg', 'jpeg', 'png'];
            $maxSize = 5000000;
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));

            if (empty($_POST['title'])) {
                $errors['title'] = 'Titre requis';
            }
            if (date('y/m/d') < $_POST['date']) {
                var_dump($_POST['date']);
                $errors['date'] = 'La date doit être postérieure à la date actuelle ';
            }
            if (!preg_match('/^[0-9]*$/', $_POST['zip'])) {
                $errors['title'] = 'Format non valide';
            }
            if (!filter_var($_POST['playlist_url'], FILTER_VALIDATE_URL) === true && !empty($_POST['playlist_url'])) {
                $errors['playlist'] = 'l\'URL n\'est pas valide';
            }
            if (!in_array($extension, $extensions) && !empty($_POST['picture'])) {
                $errors['picture'] = "Mauvaise extension";
            }
            if ($size >= $maxSize) {
                $errors['picture'] = "Fichier trop volumineux";
            }
            if (!$errors) {
                $uniqueName = uniqid('', true);
                $file = $uniqueName . "." . $extension;

                move_uploaded_file($tmpName, __DIR__ . '/../uploads' . $file);
                $party = array_map('trim', $_POST);

                $dateCreation = date('Y-m-d');

                $party['user_id'] = $this->user['id'];
                $party['picture'] = $file;
                $party['creation_date'] = $dateCreation;
                $partyadd = new PartyManager();
                $partyId = $partyadd->insert($party);

                // inscription du user connecté à sa soirée
                header('Location:/party/dashboard?party_id=' . $partyId);
                return '';
            }
        }
        return $this->twig->render('PartyAdd/partyAdd.html.twig', [
            'errors' => $errors,
        ]);
    }

    public function view(int $partyId): string
    {
        $partyManager = new PartyManager();
        $party = $partyManager->selectOneById($partyId);

        return $this->twig->render('PartyView/partyView.html.twig', [
            'party' => $party,
            'party_id' => $partyId,
        ]);
    }

    public function delete(int $partyId): void
    {
        $partyManager = new PartyManager();
        $partyManager->deleteParty($partyId);
        header('Location: /dashboard');
    }
}
