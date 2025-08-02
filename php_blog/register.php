<?php
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
        echo 'Пользователь создан<br>Все пользователи: ';
        $stmt = $pdo->prepare("SELECT * from users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            echo $user['username'] . '<br>';
        }
        echo '<a href="?action=login">Войти</a>';
    } catch (PDOException $e) {
        exit('Пользователь уже существует');
    }
} else {
    include 'templates/register.php';
}