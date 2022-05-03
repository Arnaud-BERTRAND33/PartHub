<?php

namespace App\Model;

class ShoppingManager extends AbstractManager
{
    public const FOOD_TABLE = 'food';
    public const ALCOOL_TABLE = 'alcool';

    /**Insert info Food dans table Food*/
    public function insertFood(array $food): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::FOOD_TABLE . "
        (`item`)
        VALUES (:item)");
        $statement->bindValue('item', $food['item']);
        $statement->execute();
    }

    /**Get foods dans table Food*/
    public function getFoods(): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::FOOD_TABLE);
        $statement->execute();

        return $statement->fetch() ?: null;
    }

    /**Insert info alcool dans table Food*/
    public function insertAlcool(array $alcool): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::ALCOOL_TABLE . "
        (`item`)
        VALUES (:item)");
        $statement->bindValue('item', $alcool['item']);
        $statement->execute();
    }

    /**Get alcools dans table Alcool*/
    public function getAlcool(): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::ALCOOL_TABLE);
        $statement->execute();

        return $statement->fetch() ?: null;
    }
}
