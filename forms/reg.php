<style>
  input, select, label {
    display: block;
    margin-bottom: 10px;
  }

  input[type="checkbox"] {
    margin-bottom: 0;
  }

  label {
    display: flex;
    align-items: center;

  }
</style>
<form method="post" enctype="multipart/form-data">
<input type="text" name="username" required>
<input type="email" name="email" required>
<input type="password" name="password" required>
<select name="gender" id="gender" required>
    <option value="">Выберите пол</option>
    <option value="m">Мужской</option>
    <option value="f">Женский</option>
</select>
<label for="sport">
    <input type="checkbox" name="interest[]" id="sport" value="sport"> Спорт
</label>
<label for="music">
    <input type="checkbox" name="interest[]" id="music" value="music"> Музыка
</label>
<label for="movies">
    <input type="checkbox" name="interest[]" id="movies" value="movies"> Фильмы
</label>
<input type="file" name="avatars[]" multiple>
<input type="submit" value="Отправить">
</form>
<?php 

$pathToDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(strlen($_POST['username']) < 3) die("Логин слишком короткий!");
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die("Неверный email!");
    if(strlen($_POST['password']) < 6) die("Пароль должен быть не менее 6 символов!");
    if(isset($_FILES['avatars'])) {
        $path = $_FILES['avatars']['tmp_name'];
        for($i=0; $i<count($path)-1; $i++) {
            $mime = mime_content_type($path[$i]);
            if(!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
                die('недопустимый тип файла');
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
                    echo 'Допустимый размер файла 2МБ';
                }
            }
            
        }
    }
    echo 'Готово!';
}

