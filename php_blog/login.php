<?php
session_start();
require 'includes/db.php';
require 'includes/csrf.php';
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        exit('CSRF token mismatch');
    }

    $username = sanitize($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    echo '<pre>';
    print_r($user);
    echo '</pre>';
    exit;


    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true); // 🔒 Фиксация сессии
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
    } else {
        exit('Неверный логин или пароль');
    }
} else {
    include 'templates/login.php';
}