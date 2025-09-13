<?php
$pathToDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(strlen($_POST['username']) < 3) {
        $errors[] = "username";
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "email";
    }

    if(strlen($_POST['password']) < 6) {
        $errors[] = "password";
    }

    if(empty($_POST['gender'])) {
        $errors[] = "gender";
    }

    if(isset($_FILES['avatars']) && !empty($_FILES['avatars']['name'][0])) {
        $files = $_FILES['avatars']['tmp_name'];
        for($i = 0; $i < count($files); $i++) {
            if(!empty($files[$i])) {
                $mime = mime_content_type($files[$i]);
                if(!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $errors[] = 'avatars';
                }

                if(filesize($files[$i]) > 2*1024*1024) {
                    $errors[] = 'avatars';
                }
            }
        }
    }

    if(empty($errors)) {
        if(isset($_POST['color'])) {
            $color = $_POST['color'];
        }

        if(isset($_FILES['avatars']) && !empty($_FILES['avatars']['name'][0])) {
            $files = $_FILES['avatars']['tmp_name'];
            for($i = 0; $i < count($files); $i++) {
                if(!empty($files[$i])) {
                    if(!is_dir($pathToDir)) mkdir($pathToDir);
                    $ext = pathinfo($_FILES['avatars']['name'][$i], PATHINFO_EXTENSION);
                    $name = uniqid('image_', true) . "." . $ext;
                    move_uploaded_file($files[$i], $pathToDir.DIRECTORY_SEPARATOR.$name);
                    require_once 'view.php';
                    exit;
                }
            }
        }
    }
}
?>

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
        
        
        <form method="post" enctype="multipart/form-data" id="registration-form" novalidate>
            <div class="form-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required>
                <div class="error" id="username-error">Логин должен содержать не менее 3 символов</div>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div class="error" id="email-error">Введите корректный email адрес</div>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <div class="error" id="password-error">Пароль должен быть не менее 6 символов</div>
            </div>
            
            <div class="form-group">
                <label for="gender">Пол:</label>
                <select name="gender" id="gender" required>
                    <option value="">Выберите пол</option>
                    <option value="m">Мужской</option>
                    <option value="f">Женский</option>
                </select>
                <div class="error" id="gender-error">Выберите ваш пол</div>
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
        
        <?php if (isset($color)): ?>
            <div class="color-preview" style="background-color:<?= $color ?>;">
                Выбранный цвет
            </div>
        <?php endif; ?>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const errors = <?php echo json_encode($errors); ?>;

    errors.forEach(error => {
        if(error === 'username') {
            document.getElementById('username-error').style.display = 'block';
            document.getElementById('username').classList.add('input-error');
        }
        if(error === 'email') {
            document.getElementById('email-error').style.display = 'block';
            document.getElementById('email').classList.add('input-error');
        }
        if(error === 'password') {
            document.getElementById('password-error').style.display = 'block';
            document.getElementById('password').classList.add('input-error');
        }
        if(error === 'gender') {
            document.getElementById('gender-error').style.display = 'block';
            document.getElementById('gender').classList.add('input-error');
        }
        if(error === 'avatars') {
            document.getElementById('file-error').style.display = 'block';
            document.getElementById('avatars').classList.add('input-error');
        }
    });

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