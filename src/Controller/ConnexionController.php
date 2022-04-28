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
                    return ('ERROR');
                } else {
                    return ('False password');
                }
            }
        }
        return $this->twig->render('Connexion/connexion.html.twig');
    }



    public function inscription(): string
    {
//            $firstname = trim($_POST['firstname']);
//            $lastname = trim($_POST['lastname']);
//            $email = trim($_POST['email']);
//            $password = trim($_POST['password']);
//            $confirmPassword = trim($_POST['confirmPassword']);

//            if ($_POST["password"] === $_POST["confirmPassword"]) {
//                if ($res) {
//                    echo "<div class='sucess'>
//             <h3>Vous êtes inscrit avec succès.</h3>
//             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
//           </div>";
//                }
//            } else {
//                echo "Vos mot de passe ne sont pas identiques";
//            }


                $error = array();

        if ($_POST) {
            if (!isset($_POST['firstname']) || $_POST['firstname'] === '') {
                $error['firstname'] = "Veuillez renseigner votre prénom";
            }

            if (!isset($_POST['lastname']) || $_POST['lastname'] === '') {
                $error['lastname'] = "Veuillez renseigner votre nom";
            }

            if (!isset($_POST['email']) || $_POST['email'] === '') {
                $error['email'] = "Veuillez renseigner votre adresse email";
            }

            if (!isset($_POST['password']) || $_POST['password'] === '') {
                $error['password'] = "Veuillez renseigner votre mot de passe";
            }

            if (!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] === '') {
                $error['confirmPassword'] = "Veuillez renseigner une seconde fois le mot de passe";
            }

            if (!$error && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Veuillez renseigner une adresse email valide.";
            }

            if ($_POST["password"] !== $_POST["confirmPassword"]) {
                $error['password'] = "Vos mots de passe ne sont pas identiques.";
            }

            if ($_POST["password"] === $_POST["confirmPassword"] && !$error) {
                $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $userArray = array_map('trim', $_POST);
                $userArray['password'] = $hash;
                $userManager = new userManager();
                $userManager->insert($userArray);
                header('Location:/dashboard');
                die();
            }


        }

            return $this->twig->render('Connexion/inscription.html.twig', [
                'error' => $error,
            ]);
    }
}
