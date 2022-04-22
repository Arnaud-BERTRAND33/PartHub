<?php

namespace App\Controller;

class ConnexionController extends AbstractController
{
    public function login(): string
    {
        return $this->twig->render('Connexion/connexion.html.twig');
    }

    public function inscription(): string
    {
        if ($_POST) {
            return $this->twig->render('Dashboard/dashboard.html.twig');
        }
        return $this->twig->render('Connexion/inscription.html.twig');
    }
}
