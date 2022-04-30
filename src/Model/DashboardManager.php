<?php

namespace App\Model;

class DashboardManager extends AbstractManager
{
    public const TABLE = 'event';

    public function selectAllParty(int $userId): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE user_id=:user_id");
        $statement->bindValue('user_id', $userId);
        $statement->execute();

        return $statement->fetchAll() ?: null;
    }
}
