<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use App\Model\UserManager;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;
    protected null|array|false $user;

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => (ENV === 'dev'),
            ]
        );
        $this->twig->addExtension(new DebugExtension());

        $userManager = new UserManager();
        $this->user = isset($_SESSION['user_id']) ? $userManager->selectOneById($_SESSION['user_id']) : null;
        $this->twig->addGlobal('user', $this->user);

        // add global du bout d'url
        $this->twig->addGlobal('current_uri', $_SERVER['PATH_INFO'] ?? null);

        $this->twig->addGlobal('message_flash', $_SESSION['message'] ?? null);
        unset($_SESSION['message']);
    }

    protected function addSuccessMessage(string $message): void
    {
        $_SESSION['message'] = [
            'type' => 'success',
            'message' => $message,
        ];
    }

    protected function addErrorMessage(string $message): void
    {
        $_SESSION['message'] = [
            'type' => 'danger',
            'message' => $message,
        ];
    }
}
