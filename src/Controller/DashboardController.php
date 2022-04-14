<?php

namespace App\Controller;

class DashboardController extends AbstractController
{
    public function dashboard(): string
    {
        return $this->twig->render('Dashboard/dashboard.html.twig');
    }
}
