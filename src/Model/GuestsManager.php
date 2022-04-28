<?php

namespace App\Model;

class GuestsManager extends AbstractManager
{
    public const TABLE = 'user u';
    public const TABLE2 = 'user_has_event h';

    public function selectGuests(): array|false
    {
        $query = 'SELECT u.firstname, u.lastname, u.telephone, u.email, h.participate
                  FROM user u
                  JOIN user_has_event h ON u.id=h.user_id
                  WHERE h.event_id=1;';
        $statement = $this->pdo->query($query);
//        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}

//SELECT u.firstname, u.lastname, u.telephone, u.email, h.participate
//FROM user u
//JOIN user_has_event h ON u.id=h.user_id
//WHERE h.event_id=1;


//prepared request
//$statement = $this->pdo->prepare("SELECT u.firstname, u.lastname, u.telephone, u.email, h.participate
//        FROM " . static::TABLE . "JOIN" . static::TABLE2 . "ON u.id=h.user_id WHERE h.event_id=id");
//     $statement->bindValue('id', $id, \PDO::PARAM_INT);
//$statement->execute();
//
//return $statement->fetch();
