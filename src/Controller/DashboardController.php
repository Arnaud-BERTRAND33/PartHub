<?php

namespace App\Controller;

use App\Error\LoginRequiredException;

class DashboardController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }

    public function dashboard(): string
    {
        return $this->twig->render('Dashboard/dashboard.html.twig');
    }
}
