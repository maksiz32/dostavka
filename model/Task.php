<?php

require_once 'model/User.php';

class Task {
    private string $username;
    private string $email;
    private string $description;
    private int $isDone;

    public function __construct(string $username, string $email, string $description)
    {
        $this->username = $username;
        $this->email = $email;
        $this->description = $description;
        $this->isDone = 0;
    }

    public function getUsername(): string 
    {
        return $this->username;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIsDone(): int
    {
        return $this->isDone;
    }

    public function setIsDone(): self
    {
        $this->isDone = 1;
        return $this;
    }
}