<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        
        <div class="error-message" id="global-error"></div>
        
        
        <form action="reg.php" method="post" enctype="multipart/form-data" id="registration-form" novalidate>
            <div class="form-group">
                <label for="username">Логин:<span class="star">*</span></label>
                <input type="text" id="username" name="username" 
                value="<?= isset($_POST['email']) ? htmlspecialchars($username) : '' ?>" required>
                <div class="error" id="username-error">Логин должен содержать не менее 3 символов</div>
            </div>
            
            <div class="form-group">
                <label for="email">Email:<span class="star">*</span></label>
                <input type="email" id="email" name="email"
                value="<?= isset($_POST['email']) ? htmlspecialchars($email) : '' ?>" required>
                <div class="error" id="email-error">Введите корректный email адрес</div>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:<span class="star">*</span></label>
                <input type="password" id="password" name="password"
                value="<?= !empty($_POST['password']) ? htmlspecialchars($password) : '' ?>" required>
                <div class="error" id="password-error">Пароль должен быть не менее 6 символов</div>
            </div>
            
            <div class="form-group">
                <label for="gender">Пол:</label>
                <select name="gender" id="gender">
                    <option value="">Выберите пол</option>
                    <option value="m">Мужской</option>
                    <option value="f">Женский</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Интересы:</label>
                <div class="checkbox-group">
                    <label for="sport">
                        <input type="checkbox" name="interest[]" id="sport" value="sport"> Спорт
                    </label>
                </div>
                <div class="checkbox-group">
                    <label for="music">
                        <input type="checkbox" name="interest[]" id="music" value="music"> Музыка
                    </label>
                </div>
                <div class="checkbox-group">
                    <label for="movies">
                        <input type="checkbox" name="interest[]" id="movies" value="movies"> Фильмы
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <label class="color-group">
                    Выбрать цвет:
                    <input type="color" name="color" id="color" value="#4a90e2">
                </label>
            </div>
            
            <div class="form-group file-group">
                <label for="avatars">Аватарки (максимум 10 файлов):</label>
                <input type="file" name="avatars[]" id="avatars" multiple accept="image/jpeg, image/png, image/gif">
                <div class="file-info" id="file-info"></div>
                <div class="error" id="file-error">Можно загружать только изображения (JPG, PNG, GIF) размером до 2МБ</div>
            </div>
            
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const errors =  <?php echo json_encode($errors); ?>;

    for (const field in errors) {
        if (field === 'username') {
            document.getElementById('username-error').textContent = errors[field];
            document.getElementById('username-error').style.display = 'block';
            document.getElementById('username').classList.add('input-error');
        }
        if (field === 'email') {
            document.getElementById('email-error').textContent = errors[field];
            document.getElementById('email-error').style.display = 'block';
            document.getElementById('email').classList.add('input-error');
        }
        if (field === 'password') {
            document.getElementById('password-error').textContent = errors[field];
            document.getElementById('password-error').style.display = 'block';
            document.getElementById('password').classList.add('input-error');
        }
        if (field === 'avatars') {
            document.getElementById('file-error').textContent = errors[field];
            document.getElementById('avatars').classList.add('input-error');
        }
    }

    const fileInput = document.getElementById('avatars');
    const fileInfo = document.getElementById('file-info');

    fileInput.addEventListener('change', function() {
        const files = fileInput.files;
        const errorElement = document.getElementById('file-error');
        if (files.length > 10) {
            errorElement.textContent = 'Можно выбрать не более 10 файлов';
            errorElement.style.display = 'block';
            fileInput.value = '';
            fileInfo.textContent = '';
            fileInput.classList.add('input-error');
            return;
        }

        errorElement.style.display = 'none';
        fileInput.classList.remove('input-error');
        fileInfo.textContent = files.length ? `Выбрано файлов: ${files.length}` : 'Файлы не выбраны';
    });
});
</script>

</body>
</html>