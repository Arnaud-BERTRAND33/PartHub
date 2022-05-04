<?php

namespace App\Model;

class GuestsManager extends AbstractManager
{
    public const TABLE = 'user';
    public const TABLE2 = 'user_has_party';

//recuperation tableau participant
    public function selectGuests(int $partyId): array
    {
        $query = "SELECT u.picture, u.firstname, u.lastname, u.telephone, u.email, h.participate
               FROM user u
                  JOIN user_has_party h ON u.id=h.user_id
                 WHERE h.party_id=$partyId;";
        return $this->pdo->query($query)->fetchAll();
    }
//insertion si participe, peut etre ou pas
    public function insert(array $user_has_party): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE2 . "
        (`user_id`, `party_id`, `participate`)
        VALUES (:user_id, :party_id, :participate)");

        $statement->bindValue('user_id', $user_has_party['user_id']);
        $statement->bindValue('party_id', $user_has_party['party_id']);
        $statement->bindValue('participate', $user_has_party['participate']);

        $statement->execute();
    }
}
