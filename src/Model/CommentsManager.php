<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    public const TABLE = 'comment';


    public function insert(array $comment): void
    {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`comment`, `date`, `user_id`, `event_id`)
            VALUES (:comment, NOW(), :user_id, :event_id)");
            $statement->bindValue('comment', $comment['comment']);
            $statement->bindValue('user_id', $comment['user_id']);
            $statement->bindValue('event_id', $comment['event_id']);

            $statement->execute();
    }

    public function selectByPartyId($eventId): array
    {
        $query = "SELECT c.comment, c.date, u.firstname, u.picture FROM comment c
JOIN user u ON c.user_id=u.id WHERE c.event_id=1;";

        return $this->pdo->query($query)->fetchAll() ?: [];
    }


//    public function update(array $item): bool
//    {
//        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
//        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
//        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);
//
//        return $statement->execute();
//    }
}
