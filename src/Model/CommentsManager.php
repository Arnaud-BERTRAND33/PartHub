<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    public const TABLE = 'comment';

    public function insert(array $comment): void
    {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`comment`, `date`, `user_id`, `party_id`)
            VALUES (:comment, NOW(), :user_id, :party_id)");

        $statement->bindValue('comment', $comment['comment']);
        $statement->bindValue('user_id', $comment['user_id']);
        $statement->bindValue('party_id', $comment['party_id']);
        $statement->execute();
    }

    public function selectByPartyId($partyId): array
    {
        $query = "SELECT c.comment, c.date, u.firstname, u.picture FROM comment c
JOIN user u ON c.user_id=u.id WHERE c.party_id=$partyId ORDER BY c.date ASC";

        return $this->pdo->query($query)->fetchAll() ?: [];
    }
}
