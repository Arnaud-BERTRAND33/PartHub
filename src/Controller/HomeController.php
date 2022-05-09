<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\UserManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function contact(): string
    {
        $error = array();
        if ($_POST) {
            if (!isset($_POST['name']) || $_POST['name'] === '') {
                $error['name'] = "Veuillez renseigner votre nom";
            }

            if (!isset($_POST['email']) || $_POST['email'] === '') {
                $error['email1'] = "Veuillez renseigner votre adresse email";
            }

            if (!isset($_POST['subject']) || $_POST['subject'] === '') {
                $error['subject'] = "Veuillez préciser un sujet";
            }

            if (!isset($_POST['message']) || $_POST['message'] === '') {
                $error['message'] = "Veuillez accompagner votre demande d'un message";
            }

            if (!$error && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Veuillez renseigner une adresse mail valide.";
            }

            if (!$error) {
                return $this->twig->render('Home/thanks.html.twig', [
                    '_POST' => $_POST,
                ]);
            }
        }

        return $this->twig->render('Home/contact.html.twig', [
            'error' => $error,
        ]);
    }

    public function thanks(): string
    {
        return $this->twig->render('Home/thanks.html.twig', [
            '_POST' => $_POST,
        ]);
    }
}
