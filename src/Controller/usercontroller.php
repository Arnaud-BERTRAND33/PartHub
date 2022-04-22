<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): ?string
    {
        $errors = [];

        if ($_POST) {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($email);

            if (!$user) {
                $errors['user'] = 'User introuvable';
            }

            if ($user) {
                $isPasswordOk = password_verify($password, $user['password']);
                if (!$isPasswordOk) {
                    $errors['password'] = 'Mauvais password';
                }
            }

            if (!$errors) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                return null;
            }
        }

        return $this->twig->render('User/login.html.twig', [
            'errors' => $errors,
        ]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
    }

    public function register(): ?string
    {
        if ($this->user) {
            header('Location: /');
            return null;
        }

        $errors = [];
        $userManager = new UserManager();

        if ($_POST) {
            $user = [
                'email' => $_POST['email'] ?? null,
                'password' => $_POST['password'] ?? null,
                'pseudo' => $_POST['pseudo'] ?? null,
            ];

            // TODO VALIDATION
            if (!$user['email']) {
                $errors['email'] = 'Email requis';
            }

            $existingUser = $userManager->selectOneByEmail($user['email']);

            if ($existingUser) {
                $errors['email'] = 'Email déjà utilisé';
            }

            // ......

            if (!$errors) {
                $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

                $userId = $userManager->insert($user);

                $_SESSION['user_id'] = $userId;

                header('Location: /');
            }
        }



        return $this->twig->render('User/register.html.twig', [
            'errors' => $errors,
        ]);
    }
}
