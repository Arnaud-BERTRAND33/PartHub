<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    public const TABLE = 'comment';


    public function insert(array $comment): void
    {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`comment`, `date`, `user_id`, `event_id`) VALUES (:comment, NOW(), :user_id, :event_id)");
            $statement->bindValue('comment', $comment['comment']);
            $statement->bindValue('user_id', $_SESSION['user_id']);
            $statement->bindValue('event_id', $_SESSION['event_id']);

            $statement->execute();
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
