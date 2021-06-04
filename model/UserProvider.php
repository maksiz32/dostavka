<?php

require_once 'autoload.php';

class UserProvider {
    
    private PDO $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserByLoginAndPassword(string $login, string $password): ?User {
        $statement = $this->pdo->prepare(
            'SELECT * FROM `users` WHERE login = :login'
        );
        if (!$statement) {
            return null;
        }

        $statement->execute([
            'login' => $login
        ]);
        $res = $statement->fetchObject(User::class, [$login]);

        if ($res && ($password === $res->getPassword())) {
            return $res;
        } else {
            return null;
        }
    }

    //Для набора данных с помощью консольного скрипта fixture.php
    public function insert(User $user): bool 
    {
        $statement = $this->pdo->prepare("INSERT INTO `users` (login, password, email) 
                                        VALUES
                                        (:login, :password, :email)");

        return $statement && $statement->execute([
            'login' => $user->getLogin(),
            'password' => $user->getPassword(), 
            'email' => $user->getEmail()
        ]);
    }
}