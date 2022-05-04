<?php

namespace App\Model;

class AlcoolManager extends AbstractManager
{
    public const TABLE = 'alcool';

    /**Insert info Alcool dans table Alcool*/
    public function insertAlcool(array $alcool): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`item`,`party_id`, `user_id` )
        VALUES (:item, :party_id, :user_id)");
        $statement->bindValue('item', $alcool['item']);
        $statement->bindValue('party_id', $alcool['party_id']);
        $statement->bindValue('user_id', $alcool['user_id']);
        $statement->execute();
    }

    /**Get alcools dans table Alcool*/
    public function getAlcools(string $partyId): ?array
    {
        $alcools = $this->selectAllByPartyId($partyId);
        return $alcools;
    }
}
