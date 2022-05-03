<?php

namespace App\Model;

class GuestsManager extends AbstractManager
{
    public const TABLE = 'user';
    public const TABLE2 = 'user_has_party';

    public function selectGuests(): array
    {
        $query = 'SELECT u.picture, u.firstname, u.lastname, u.telephone, u.email, h.participate
               FROM user u
                  JOIN user_has_party h ON u.id=h.user_id
                 WHERE h.party_id=1;';
        return $this->pdo->query($query)->fetchAll();
    }
}
