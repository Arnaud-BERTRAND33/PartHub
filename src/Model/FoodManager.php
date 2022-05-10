<?php

namespace App\Model;

class FoodManager extends AbstractManager
{
    public const TABLE = 'food';

    /**Insert info Food dans table Food*/
    public function insertFood(array $food): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`item`,`party_id`, `user_id` )
        VALUES (:item, :party_id, :user_id)");
        $statement->bindValue('item', $food['item']);
        $statement->bindValue('party_id', $food['party_id']);
        $statement->bindValue('user_id', $food['user_id']);
        $statement->execute();
    }

    /**Get foods dans table Food*/
    public function getFoods(int $partyId): ?array
    {
        $foods = $this->selectAllByPartyId($partyId);
        return $foods;
    }

    public function delete(int $foodId): void
    {
        $statement = $this->pdo->prepare("DELETE FROM food WHERE id = $foodId");
        $statement->execute();
    }
}
