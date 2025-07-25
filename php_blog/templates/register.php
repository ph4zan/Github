<form method="POST" action="/github/php_blog/register.php">
    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
    <input name="username" required placeholder="Имя пользователя">
    <input name="password" type="password" required placeholder="Пароль">
    <p><img src="./includes/captcha.php" alt="Капча"></p>
    <p>
        <label>Введите капчу:</label><br>
        <input type="text" name="captcha" required>
    </p>
    <button type="submit">Регистрация</button>
</form>