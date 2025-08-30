<?php
$pathToDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(strlen($_POST['username']) < 3) {
        $errors['username'] = "Логин слишком короткий!";
    }
   
     if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Неверный email!";
    }
    if(strlen($_POST['password']) < 6) {
        $errors['password'] = "Пароль должен быть не менее 6 символов!";    
    }
    if(isset($_FILES['avatars'])) {
        $path = $_FILES['avatars']['tmp_name'];
        for($i=0; $i<count($path)-1; $i++) {
            $mime = mime_content_type($path[$i]);
            if(!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
                $errors['avatars'][] = 'недопустимый тип файла';
            }
            if($size = getimagesize($path[$i])) {
                if(filesize($path[$i]) < 2*1024*1024) {
                    if(!is_dir($pathToDir)) {
                        mkdir($pathToDir);
                    }
                    $ext = pathinfo($_FILES['avatars']['name'][$i], PATHINFO_EXTENSION);
                    $name = uniqid('image_', true) . "." . $ext;
                    move_uploaded_file($path[$i], $pathToDir.DIRECTORY_SEPARATOR.$name);
                } else {
                    $errors['avatars'][] = 'Допустимый размер файла 2МБ';
                }
            }
            
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

form {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 12px;
    margin: 5px 0;
    border: 2px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus {
    outline: none;
    border-color: #007bff;
}

input::placeholder {
    color: #999;
    font-size: 14px;
}

select {
    cursor: pointer;
    background-color: white;
}

.checkbox-group {
    margin-top: 10px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    font-weight: normal;
    cursor: pointer;
}

input[type="checkbox"] {
    margin-right: 10px;
    width: auto;
}

input[type="file"] {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    border: 2px dashed #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    cursor: pointer;
}

input[type="file"]:hover {
    border-color: #007bff;
}

.file-hint {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-weight: 600;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Стили для ошибок */
.error-message {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
    min-height: 20px;
    display: none;
}

.error-message.show {
    display: block;
}

input.error,
select.error {
    border-color: #dc3545;
}

/* Для лучшего отображения на мобильных устройствах */
@media (max-width: 480px) {
    form {
        margin: 20px;
        padding: 20px;
    }
    
    body {
        align-items: flex-start;
        padding-top: 20px;
    }
}
    </style>
</head>
<body>
   <form method="post" enctype="multipart/form-data" id="myForm">
    <!-- Поле для отображения общих ошибок -->
    <div class="error-message" id="generalError"></div>
    
    <!-- Имя пользователя -->
    <div class="form-group">
        <label for="username">Имя пользователя *</label>
        <input type="text" name="username" id="username" placeholder="Введите ваше имя" required>
        <div class="error-message" id="usernameError">Ошибка имя </div>
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email" placeholder="example@mail.com" required>
        <div class="error-message" id="emailError">Ошибка почты</div>
    </div>

    <!-- Пароль -->
    <div class="form-group">
        <label for="password">Пароль *</label>
        <input type="password" name="password" id="password" placeholder="Не менее 6 символов" required>
        <div class="error-message" id="passwordError">Ошибка пароля</div>
    </div>

    <!-- Пол -->
    <div class="form-group">
        <label for="gender">Пол *</label>
        <select name="gender" id="gender" required>
            <option value="">Выберите пол</option>
            <option value="m">Мужской</option>
            <option value="f">Женский</option>
        </select>
        <div class="error-message" id="genderError"></div>
    </div>

    <!-- Интересы -->
    <div class="form-group">
        <label>Интересы</label>
        <div class="checkbox-group">
            <label for="sport" class="checkbox-label">
                <input type="checkbox" name="interest[]" id="sport" value="sport"> Спорт
            </label>
            <label for="music" class="checkbox-label">
                <input type="checkbox" name="interest[]" id="music" value="music"> Музыка
            </label>
            <label for="movies" class="checkbox-label">
                <input type="checkbox" name="interest[]" id="movies" value="movies"> Фильмы
            </label>
        </div>
        <div class="error-message" id="interestError"></div>
    </div>

    <!-- Файлы -->
    <div class="form-group">
        <label for="avatars">Аватарки</label>
        <input type="file" name="avatars[]" id="avatars" multiple>
        <div class="file-hint">Можно выбрать несколько файлов</div>
        <div class="error-message" id="fileError"></div>
    </div>

    <!-- Кнопка отправки -->
    <div class="form-group">
        <input type="submit" value="Зарегистрироваться">
    </div>
</form>
<script>
    // Чтобы показать ошибку
<?php if (!empty($errors)): ?>
    const errors = <?php echo json_encode($errors); ?>
<?php endif; ?>

    if (errors.username) {
        document.getElementById('usernameError').textContent = errors.username;
        document.getElementById('usernameError').classList.add('show');
        document.getElementById('username').classList.add('error');
    }
    if (errors.email) {
        document.getElementById('emailError').textContent = errors.email;
        document.getElementById('emailError').classList.add('show');
        document.getElementById('email').classList.add('error');
    }
    if (errors.password) {
        document.getElementById('passwordError').textContent = errors.password;
        document.getElementById('passwordError').classList.add('show');
        document.getElementById('password').classList.add('error');
    }
    if (errors.avatars) {
        document.getElementById('fileError').textContent = errors.avatars.join(', ');
        document.getElementById('fileError').classList.add('show');
        document.getElementById('avatars').classList.add('error');
    }
    document.getElementById('generalError').textContent = "Пожалуйста, исправьте ошибки в форме.";
    document.getElementById('generalError').classList.add('show');
</script>
</body>
</html>