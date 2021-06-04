<?php
require_once 'model/TaskProvider.php';
$pdo = require 'dbconnect.php';

$user = null;

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$username = $user ? $user : null;

$pageName = 'Главная страница';

if (isset($_GET['action']) && $_GET['action'] === 'taskdone') {
    (new TaskProvider($pdo))->setTaskDone();
    header('Location: /?controller=home');
}

if (isset($_GET['action']) && $_GET['action'] === 'newtask') {
    (new TaskProvider($pdo))->addTask();
    header('Location: /?controller=home');
}

$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'username';
$curPage = (isset($_GET['page'])) ? $_GET['page'] : 1;

$res = new TaskProvider($pdo);

$param = $res->getParams($sort);
$limit = 3;
$countItems = $res->getCountItems();

$pag = new Paginator($limit, $countItems);
$offset = $pag->getOffset($curPage);
$countPages = $pag->getPages();
$tasks = $res->getTasksList($param, $offset, $limit);

require_once 'view/home.php';
