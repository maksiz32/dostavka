<?php

require_once 'autoload.php';

/** @var PDO $pdo*/
$pdo = require 'dbconnect.php';

// Начальные данные для users
$pdo->exec('CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  login VARCHAR(150) NOT NULL,
  password VARCHAR(150) NOT NULL,
  email VARCHAR(255) NOT NULL
)');

$user = new User('admin');
$user->setPassword('123');
$user->setEmail('admin@admin.ru');

$userProvider = new UserProvider($pdo);
$result = $userProvider->insert($user);
if(!$result) {
    echo "Неудалось создать пользователя\n";
}

//Создание таблицы в БД для Task
$pdo->exec('CREATE TABLE tasks (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, username VARCHAR(150), 
    email VARCHAR(255), description VARCHAR(255), isDone TINYINT)');

$task1 = new Task('user1', 'user1@user.ru', 'Первая задача');
$task2 = new Task('user2', 'user2@user.ru', 'Вторая задача');
$task3 = new Task('user3', 'user3@user.ru', 'Третья задача');
$task4 = new Task('user4', 'user4@user.ru', 'Четвертая задача');
$task5 = new Task('user5', 'user5@user.ru', 'Пятая задача');
$task6 = new Task('user6', 'user6@user.ru', 'Шестая задача');
$task7 = new Task('user7', 'user7@user.ru', 'Седьмая задача');
$task8 = new Task('user8', 'user8@user.ru', 'Восьмая задача');
$task9 = new Task('user9', 'user9@user.ru', 'Девятая задача');

$fakeData = [$task1, $task2, $task3, $task4, $task5, $task6, $task7, $task8, $task9];

//Добавляю тестовые данные в таблицу tasks
$taskProvider = new TaskProvider($pdo);
foreach($fakeData as $fake) {
  $result = $taskProvider->insert($fake);
  if(!$result) {
      echo "Неудалось вставить данные\n";
  }
}