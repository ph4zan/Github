<?php
session_start();
require 'includes/db.php';
require 'includes/csrf.php';
require 'includes/functions.php';

const PERM_READ   = 1 << 0;
const PERM_WRITE  = 1 << 1;
const PERM_EDIT   = 1 << 2;
const PERM_DELETE = 1 << 3;

if(isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT rights from users where id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $rights = $stmt->fetchColumn();
    if($rights & PERM_DELETE) {
        echo '<a href="?action=admin">Админ-Панель</a><br>';
    }
    if($rights & PERM_WRITE) {
        echo '<a href="?action=add">Добавление поста</a><br>';
    }
}


if (!isset($rights) && !isset($_GET['action'])) {
    echo '<a href = "?action=login">Войти</a> | ';
    echo '<a href = "?action=reg">Зарегистрироваться</a>';
} elseif(isset($rights)) {
    echo 'Вы вошли! <a href="logout.php">Выйти</a><br>';
}

if (isset($_GET['action'])) {
    if ($_GET['action']=='login') {
        include 'login.php';
    } elseif($_GET['action']=='reg') {
        include 'register.php';
    } elseif($_GET['action']=='logout') {
        include 'logout.php';
    } elseif($_GET['action']=='add' && $rights & PERM_WRITE) {
        include 'add.php';
        exit;
    } elseif($_GET['action']=='edit' && $rights & PERM_EDIT) {
        include 'edit.php';
        exit;
    } elseif($_GET['action']=='admin' && $rights & PERM_DELETE) {
        include 'admin.php';
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * from posts");
$stmt->execute();
$posts = $stmt->fetchAll();
foreach ($posts as $post) {
    echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
    if (!empty($post['image'])) {
        echo "<img src='" . htmlspecialchars($post['image']) . "' alt='Post image' style='max-width:300px;'><br>";
    }
    if (!empty($post['content'])) {
        echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
    }
    echo "<hr>";
}