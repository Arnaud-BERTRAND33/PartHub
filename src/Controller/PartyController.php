<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\PartyManager;
use DateTime;

class PartyController extends AbstractController
{
    public function add(): string
    {

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
                $party = array_map('trim', $_POST);
                if ($_FILES['picture']['error'] === UPLOAD_ERR_NO_FILE) {
                    $party['picture'] = 'default.jpg';
                } else {
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;
                    $party['picture'] = $file;
                    move_uploaded_file($file, '../uploads/');
                }

                $date = new DateTime();
                $dateCreation = $date->format('Y-m-d-H-i-s');
                $party['date'] = $_POST['date'] . " " . $_POST['time'];
                $party['user_id'] = $this->user['id'];
                $party['creation_date'] = $dateCreation;
                $partyadd = new PartyManager();
                $partyId = $partyadd->insert($party);
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

    public function update(int $partyId): string
    {

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
            if (!isset($_POST['picture'])) {
                $party['picture'] = '';
            }
            if (!$errors) {
                $party = array_map('trim', $_POST);
                if ($_FILES['picture']['error'] === UPLOAD_ERR_NO_FILE) {
                    $party['picture'] = 'default.jpg';
                } else {
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;
                    $party['picture'] = $file;
                    move_uploaded_file($file, '../uploads/');
                }

                $date = new DateTime();
                $dateCreation = $date->format('Y-m-d-H-i-s');
                $party['date'] = $_POST['date'] . " " . $_POST['time'];
                $party['user_id'] = $this->user['id'];
                $party['creation_date'] = $dateCreation;
                $partyadd = new PartyManager();
                $partyId = $partyadd->update($party, $partyId);

                header('Location:/party/view?party_id=' . $partyId);
                return '';
            }
        }
        $partyManager = new PartyManager();
        $party = $partyManager->selectOneById($partyId);
        return $this->twig->render('PartyUpdate/partyUpdate.html.twig', [
            'errors' => $errors,
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
