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

    if (!is_valid_username($username) || !is_valid_password($password)) {
        exit('Имя ≥ 3 символов, пароль ≥ 6');
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    try {
        $stmt->execute([$username, $hash]);
        header('Location: login.php');
    } catch (PDOException $e) {
        exit('Пользователь уже существует');
    }
} else {
    include 'templates/register.php';
}