<form method="POST" action="/php_blog/login.php">
    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
    <input name="username" required placeholder="Имя пользователя">
    <input name="password" type="password" required placeholder="Пароль">
    <button type="submit">Войти</button>
</form> 
<p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>