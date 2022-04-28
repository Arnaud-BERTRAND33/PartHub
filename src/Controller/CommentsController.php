<?php

namespace App\Controller;

use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    public function comments(): string
    {
        $CommentManager = new CommentsManager();
        $comment = $CommentManager->selectAll('date');

        return $this->twig->render('Comments/comments.html.twig', [
            'comment' => $comment
        ]);
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = array_map('trim', $_POST);

            $CommentManager = new CommentsManager();
            $CommentManager->insert($comment);

            header('Location:');
            die();
        }
    }
}
