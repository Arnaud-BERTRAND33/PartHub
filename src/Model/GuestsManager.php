<?php

namespace App\Model;

class GuestsManager extends AbstractManager
{
    public const TABLE = 'item';

    /**
     * Insert new item in database
     */
    public function insert(array $guests): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $guests['title'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}

//SELECT u.firstname, u.lastname, u.telephone, u.email
//FROM user u
//JOIN user_has_event h ON u.id=h.user_id
//WHERE h.event_id=1;
