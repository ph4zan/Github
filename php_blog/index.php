<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /php_blog/login.php');
    exit;
}
echo 'Вы вошли! <a href="logout.php">Выйти</a>';