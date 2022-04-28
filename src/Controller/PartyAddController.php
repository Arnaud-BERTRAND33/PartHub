<?php

namespace App\Controller;

use App\Model\PartyAddManager;

class PartyAddController extends AbstractController
{
    public function add(): string
    {
        /** Sécurisation formulaire partyadd */
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (empty($_POST['title'])) {
                $errors['title'] = 'Titre requis';
            }

            if (date('d/m/y') < $_POST['date']) {
                $errors['date'] = 'La date doit être postérieure à la date actuelle ';
            }

            if (preg_match("#^[0-9]{1,2}$#", $_POST['zip'])) {
            } else {
                $errors['title'] = 'Format non valide';
            }

            if (!filter_var($_POST['playlist'], FILTER_VALIDATE_URL) === true) {
                $errors['playlist'] = 'l\'URL n\'est pas valide';
            }
        }
        return $this->twig->render('PartyAdd/partyAdd.html.twig');
    }
}
