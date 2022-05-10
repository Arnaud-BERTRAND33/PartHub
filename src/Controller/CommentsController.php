<?php

namespace App\Controller;

use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    public function comments(int $partyId): string
    {
        $commentManager = new CommentsManager();

        $comments = $commentManager->selectByPartyId($partyId);

        $error = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['comment']) || $_POST['comment'] === '') {
                $error['comment'] = 'Veuillez écrire un commentaire';
            }
            if (!$error) {
                $comment = array_map('trim', $_POST);

                $comment['party_id'] = $_GET['party_id'];
                $comment['user_id'] = $this->user['id'];

                $commentsManager = new CommentsManager();
                $commentsManager->insert($comment);
                header('Location: /party/comments?party_id=' . $partyId);
                return '';
            }
            return $this->twig->render('Comments/comments.html.twig', [
                'error' => $error,
                'comments' => $comments,
            ]);
        }
        return $this->twig->render('Comments/comments.html.twig', [
            'comments' => $comments,
            'party_id' => $partyId,

        ]);
    }
}
