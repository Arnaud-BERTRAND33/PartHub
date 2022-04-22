<?php

namespace App\Controller;

use App\Model\UserManager;

class ConnexionController extends AbstractController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $connexionManager = new UserManager();
            $user = $connexionManager->selectOneByEmail($credentials['email']);
            if ($user && password_verify($credentials['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: Dashboard/dashboard.html.twig');
            } else {
                if (!$user) {
                    return ('PAS USER');
                } else {
                    return ('MAUVAIS MDP');
                }
            }
            return $this->twig->render('Connexion/connexion.html.twig');
        }
    }


    public function inscription(): string
    {
        return $this->twig->render('Connexion/inscription.html.twig');
    }
}
