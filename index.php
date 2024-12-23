<?php
require_once __DIR__ . '/../app/controllers/ItemController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace("/phpProject/public", "", $uri);

if ($uri === '/add-item') {
    (new ItemController())->add();
} elseif ($uri === '/delete-item') {
    (new ItemController())->delete();
} elseif ($uri === '/add-user') {
    (new UserController())->add();
} elseif ($uri === '/delete-user') {
    (new UserController())->delete();
} elseif ($uri === '/login') {
    (new UserController())->login();
} elseif ($uri === '/register') {
    (new UserController())->register();
} else {
    include "./home.php";
}
?>
