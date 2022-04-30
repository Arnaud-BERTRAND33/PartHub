<?php

namespace App\Controller;

use App\Error\LoginRequiredException;

class CommentsController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }
    public function comments(): string
    {
        // récuparations des commentaires de la party $partyId
        // $comments = TODO

        return $this->twig->render('Comments/comments.html.twig', [
            // 'comments' => $comments,
        ]);
    }
}
