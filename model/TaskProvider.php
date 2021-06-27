<?php

require_once 'model/Task.php';

class TaskProvider {

    private PDO $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCountItems(): int 
    {
        $statement = $this->pdo->query("SELECT COUNT(*) FROM `tasks`");
        $res = $statement->fetch();
        return $res['COUNT(*)'];
    }

    public function getParams(string $sort): string
    {
        switch ($sort) {
            case 'email':
                $_SESSION['sort'] = $param = 'email';
                break;
            case 'isDone':
                $_SESSION['sort'] = $param = 'isDone';
                break;
            default:
                $_SESSION['sort'] = $param = 'username';
        }
        return $param;
    }

    public function getTasksList(string $sort = 'username', int $offset, ?int $limit = null): array {
        $arr = [];
        if(!$limit) {
            $statement = $this->pdo->query("SELECT * FROM `tasks` ORDER BY {$sort}");
        } else {
            $statement = $this->pdo->query("SELECT * FROM `tasks` ORDER BY {$sort} LIMIT {$offset}, {$limit}");
        }
        $res = $statement->fetchAll();
        if($res) {
            foreach($res as $result) {
                $arr[] =  [
                    'id' => $result['id'],
                    'username' => $result['username'],
                    'email' => $result['email'],
                    'description' => $result['description'],
                    'isDone' => $result['isDone']
                ];
            }
        }
        return $arr;
    }

    public function addTask(): bool {
        ['username' => $username, 'email' => $email, 'newtask' => $newtask] = $_POST;
        $request = $_POST['newtask'];
        
        if ($username !== '' && $email !== "" && $newtask !== "") {
            $task = new Task($username, $email, $newtask);
            $statement = $this->pdo->prepare("INSERT INTO `tasks` (username, email, description, isDone) 
                                    VALUES (:username, :email, :description, :isDone)");
            $statement->execute([
                'username' => $task->getUsername(),
                'email' => $task->getEmail(),
                'description' => $task->getDescription(),
                'isDone' => $task->getIsDone()
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function setTaskDone(): bool {
        $id = $_GET['task'];
        $statement = $this->pdo->prepare(('SELECT * FROM tasks WHERE id = :id LIMIT 1'));
        $statement->execute(([
            'id' => $id
        ]));
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        if($res) {
            $query = "UPDATE tasks SET isDone = 1 WHERE (id = {$id})";
            $statement = $this->pdo->query($query);
            return true;
        } else {
            return false;
        }
    }

    //Для набора данных с помощью консольного скрипта fixture.php
    public function insert(Task $task): bool 
    {
        $statement = $this->pdo->prepare("INSERT INTO `tasks` (username, email, description, isDone) 
                                        VALUES
                                        (:username, :email, :description, :isDone)");

        return $statement && $statement->execute([
            'username' => $task->getUsername(),
            'email' => $task->getEmail(), 
            'description' => $task->getDescription(),
            'isDone' => $task->getIsDone()
        ]);
    }
}