<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectOneByEmail(string $email): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue('email', $email);
        $statement->execute();

        return $statement->fetch() ?: null;
    }

    public function insert(array $user): int
    {

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (firstname, lastname, email, password)
         VALUES (:firstname, :lastname, :email, :password)");

        $statement->bindValue('firstname', $user ['firstname']);
        $statement->bindValue('lastname', $user['lastname']);
        $statement->bindValue('email', $user['email']);
        $statement->bindValue('password', $user['password']);



        $statement->execute([
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'password' => $user['password'],
        ]);

        return (int)$this->pdo->lastInsertId();
    }
}
