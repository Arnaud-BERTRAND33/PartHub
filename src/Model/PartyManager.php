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
        $statement = $this->pdo->prepare("SELECT p.id, p.picture, p.title, p.theme, p.date, p.address, p.city, p.zip, p.description, p.playlist_url, p.creation_date, p.user_id, h.party_id as party_guest_id, h.user_id as guest_id
FROM party p
LEFT JOIN user_has_party h ON h.party_id = p.id
WHERE p.user_id=:user_id OR h.user_id=:user_id;");
        $statement->bindValue('user_id', $userId);
        $statement->execute();

        return $statement->fetchAll() ?: null;
    }

    public function update(array $party, int $partyId): int | bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET
        `picture` = :picture,
        `title` = :title,
        `theme` = :theme,
        `date` = :date,
        `address` = :address,
        `city` = :city,
        `zip` = :zip,
        `description` = :description,
        `playlist_url` = :playlist_url
        WHERE id = $partyId");

        $statement->bindValue('picture', $party['picture']);
        $statement->bindValue('title', $party['title']);
        $statement->bindValue('theme', $party['theme']);
        $statement->bindValue('date', $party['date']);
        $statement->bindValue('address', $party['address']);
        $statement->bindValue('city', $party['city']);
        $statement->bindValue('zip', $party['zip']);
        $statement->bindValue('description', $party['description']);
        $statement->bindValue('playlist_url', $party['playlist_url']);

        return $statement->execute();
    }

    public function deleteParty(int $partyId): void
    {
        $statement = $this->pdo->prepare("DELETE FROM party WHERE party.id = $partyId");
        $statement->execute();
    }
}
