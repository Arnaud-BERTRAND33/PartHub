<?php

namespace App\Model;

class PartyAddManager extends AbstractManager
{
    public const TABLE = 'event';

    /**Insert info Event dans table Event*/
    public function insert(array $event): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`picture`, `title`, `theme`, `date`, `place_url`, `address`, `city`, `zip`, `description`, `playlist_url`)
        VALUES (:picture, :title, :theme, :date, :place_url, :address, :city, :zip, :description, :playlist_url)");
        $statement->bindValue('picture', $event['picture']);
        $statement->bindValue('title', $event['title']);
        $statement->bindValue('theme', $event['theme']);
        $statement->bindValue('date', $event['date']);
        $statement->bindValue('place_url', $event['place_url']);
        $statement->bindValue('address', $event['address']);
        $statement->bindValue('city', $event['city']);
        $statement->bindValue('zip', $event['zip']);
        $statement->bindValue('playlist_url', $event['playlist_url']);

        $statement->execute();
    }

//    /**
//     * Update item in database
//     */
//    public function update(array $item): bool
//    {
//        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
//        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
//        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);
//
//        return $statement->execute();
//    }
}
