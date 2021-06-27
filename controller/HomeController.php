<?php
require_once 'model/TaskProvider.php';
$pdo = require 'dbconnect.php';

$user = null;

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$username = $user ?? $user;

$pageName = 'Главная страница';

if (isset($_GET['action']) && $_GET['action'] === 'taskdone') {
    (new TaskProvider($pdo))->setTaskDone();
    header('Location: /?controller=home');
}

if (isset($_GET['action']) && $_GET['action'] === 'newtask') {
    (new TaskProvider($pdo))->addTask();
    header('Location: /?controller=home');
}

$curPage = (isset($_GET['page'])) ? $_GET['page'] : 1;

$param = $_GET['sort'] ?? 'username';
$res = new TaskProvider($pdo);
if(!isset($_SESSION['sort']) && $param) {
    $param = $res->getParams('h');
}
if(isset($_SESSION['sort'])) {
    $param = $res->getParams($_SESSION['sort']);
}
if(isset($_GET['sort'])) {
    $param = $res->getParams($_GET['sort']);
}

$limit = 3;
$countItems = $res->getCountItems();

$pag = new Paginator($limit, $countItems);
$offset = $pag->getOffset($curPage);
$countPages = $pag->getPages();
$tasks = $res->getTasksList($param, $offset, $limit);

require_once 'view/home.php';
