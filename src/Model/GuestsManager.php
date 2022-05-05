<?php

namespace App\Model;

class GuestsManager extends AbstractManager
{
    public const TABLE = 'user_has_party';

//recuperation tableau participant
    public function selectGuests(int $partyId): array
    {
        $query = "SELECT u.id, u.picture, u.firstname, u.lastname, u.telephone, u.email, h.participate
               FROM user u
                  JOIN user_has_party h ON u.id=h.user_id
                 WHERE h.party_id=$partyId;";
        return $this->pdo->query($query)->fetchAll();
    }
//insertion si participe, peut-être, ou pas
    public function insertGuests(array $participate): void
    {
        $statement = $this->pdo->prepare("UPDATE " . SELF::TABLE . " SET `participate`=:participate
        WHERE `user_id`=:user_id AND `party_id`=:party_id");

        $statement->bindValue('user_id', $participate['user_id']);
        $statement->bindValue('party_id', $participate['party_id']);
        $statement->bindValue('participate', $participate['participate']);

        $statement->execute();
    }
}
