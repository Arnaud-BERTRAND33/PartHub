<?php

namespace App\Controller;

class CommentsController extends AbstractController
{
    public function comments(): string
    {
        return $this->twig->render('Comments/comments.html.twig');
    }
}
