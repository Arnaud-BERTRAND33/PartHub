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
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`, password, pseudo)
         VALUES (:email, :password, :pseudo)");

        $statement->execute([
            'email' => $user['email'],
            'password' => $user['password'],
            'pseudo' => $user['pseudo'],
        ]);

        return (int)$this->pdo->lastInsertId();
    }
}
