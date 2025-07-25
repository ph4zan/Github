<?php
session_start();
require 'includes/db.php';
require 'includes/csrf.php';
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userCaptcha = trim($_POST['captcha'] ?? '');
    $realCaptcha = $_SESSION['captcha_text'] ?? '';

    if (strcasecmp($userCaptcha, $realCaptcha) !== 0) {
    die("❌ Неверная капча. Попробуйте снова.");
    }

    unset($_SESSION['captcha_text']);

    if (!verify_csrf_token($_POST['csrf_token'])) {
        exit('CSRF token mismatch');
    }

    $username = sanitize($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true); // 🔒 Фиксация сессии
        $_SESSION['user_id'] = $user['id'];
        header('Location: /github/php_blog/index.php');
    } else {
        exit('Неверный логин или пароль');
    }
} else {
    include 'templates/login.php';
}