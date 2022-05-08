<?php

namespace App\Model;

class PartyManager extends AbstractManager
{
    public const TABLE = 'party';

    public function insert(array $party): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`picture`, `title`, `theme`, `date`, `address`, `city`, `zip`, `description`,
         `playlist_url`, `user_id`, `creation_date`)
        VALUES (:picture, :title, :theme, :date, :address, :city, :zip, :description,
         :playlist_url, :user_id, :creation_date)");
        $statement->bindValue('picture', $party['picture']);
        $statement->bindValue('title', $party['title']);
        $statement->bindValue('theme', $party['theme']);
        $statement->bindValue('date', $party['date']);
        $statement->bindValue('address', $party['address']);
        $statement->bindValue('city', $party['city']);
        $statement->bindValue('zip', $party['zip']);
        $statement->bindValue('description', $party['description']);
        $statement->bindValue('playlist_url', $party['playlist_url']);
        $statement->bindValue('user_id', $party['user_id']);
        $statement->bindValue('creation_date', $party['creation_date']);

        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function selectAllParty(int $userId): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE user_id=:user_id");
        $statement->bindValue('user_id', $userId);
        $statement->execute();

        return $statement->fetchAll() ?: null;
    }

    public function deleteParty(int $partyId): void
    {
        $statement = $this->pdo->prepare("DELETE FROM party WHERE party.id = $partyId");
        $statement->execute();
    }
}
