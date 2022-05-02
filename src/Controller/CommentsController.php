<?php

namespace App\Controller;


use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    public function comments(int $eventId): string
    {
        $commentManager = new CommentsManager();

        $comments = $commentManager->selectByPartyId($eventId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = array_map('trim', $_POST);

            $comment['event_id'] = '1';
            $comment['user_id'] = '2';

            $commentsManager = new CommentsManager();
            $commentsManager->insert($comment);
            header('Location: /party/comments?party_id=' . $eventId);
            return '';
        }

        return $this->twig->render('Comments/comments.html.twig', [
            'comments' => $comments,
        ]);
    }
}
