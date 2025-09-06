<form method="post" enctype="multipart/form-data">
    <input type="file" name="avatar">
    <input type="submit" value="submit">
</form>

<?php
$pathToDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
if(isset($_FILES['avatar'])) {
    $path = $_FILES['avatar']['tmp_name'];
    $mime = mime_content_type($path);
    if(in_array($mime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
        if($size = getimagesize($path)) {
            if(filesize($path) < 2*1024*1024) {
                if(!is_dir($pathToDir)) {
                    mkdir($pathToDir);
                }
                $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $name = uniqid('image_', true) . "." . $ext;
                move_uploaded_file($path, $pathToDir.DIRECTORY_SEPARATOR.$name);
                echo 'Готово!';
            } else {
                echo 'Допустимый размер файла 2МБ';
            }
        }
    } else {
        echo 'недопустимый тип файла';
    }
}