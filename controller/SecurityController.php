<?php
$pageName = 'Авторизация';

$pdo = require 'dbconnect.php';

$errors = [];

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['user']);
    header('Location: /');
}

if (isset($_POST['login'], $_POST['password'])) {
    ['login' => $login, 'password' => $password] = $_POST;

    $userProvider = new UserProvider($pdo);
    $user = $userProvider->getUserByLoginAndPassword($login, $password);
    if ($user === null) {
        $errors[] = 'Введены неверные учетные данные';
    } else {
        $_SESSION['user'] = $user->getLogin();;
        header('Location: /');
    }
}

require_once 'view/signin.php';