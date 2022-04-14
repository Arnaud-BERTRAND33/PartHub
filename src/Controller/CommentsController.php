<?php

namespace App\Controller;

class CommentsController extends AbstractController
{
    public function comments(int $partyId): string
    {
        // récuparations des commentaires de la party $partyId
        // $comments = TODO

        return $this->twig->render('Comments/comments.html.twig', [
            // 'comments' => $comments,
        ]);
    }
}
