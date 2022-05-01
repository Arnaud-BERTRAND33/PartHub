<?php

namespace App\Model;

class GuestsManager extends AbstractManager
{
    public const TABLE = 'user';
    public const TABLE2 = 'user_has_event';

    public function selectGuests(): array
    {
        $query = 'SELECT u.picture, u.firstname, u.lastname, u.telephone, u.email, h.participate
               FROM user u
                  JOIN user_has_event h ON u.id=h.user_id
                 WHERE h.event_id=1;';
        return $this->pdo->query($query)->fetchAll();
    }
}
