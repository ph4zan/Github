<?php
function isSaveFile($f) {
        $imageNames = [];
        $errors = [];
        $mime = mime_content_type($f);
        if(!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
            $errors["avatars"] = 'avatars';
        }
        if(filesize($f) > 2*1024*1024) {
            $errors[] = 'avatars';
        }
        return (empty($errors)) ? [true, []] : [false, $errors];
    }



$pathToDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';

if(!is_dir($pathToDir)) mkdir($pathToDir);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $color = $_POST['color'];

    if(strlen($_POST['username']) < 3) {
        $errors["username"] = "Логин должен содержать не менее 3 символов";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Введите корректный email адрес";

    }

    if(strlen($password) < 6) {
        $errors["password"] = "Пароль должен быть не менее 6 символов";

    }


    foreach($_FILES['avatars']['tmp_name'] as $key => $tmpName) { 
        if ($_FILES['avatars']['error'][$key] === UPLOAD_ERR_OK) {
            if(!isSaveFile($tmpName)[0]) {
                $errors['avatars'] = isSaveFile($tmpName)[1];
            } elseif($errors == []) {
                $ext = pathinfo($_FILES['avatars']['name'][$key], PATHINFO_EXTENSION);
                $imageNames []= uniqid('image_', true) . "." . $ext;
                move_uploaded_file($tmpName, $pathToDir.DIRECTORY_SEPARATOR.$imageNames[$key]);
            }
        }       
    }
}
if (!empty($errors)) {
    require_once "form.php"; 
} else {
    require_once "result.php";
}


//     if(isset($_FILES['avatars']) && !empty($_FILES['avatars']['name'][0])) {
//         $files = $_FILES['avatars']['tmp_name'];
//         for($i = 0; $i < count($files); $i++) {
//             if(!empty($files[$i])) {
//                 $mime = mime_content_type($files[$i]);
//                 if(!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
//                     $errors[] = 'avatars';
//                 }

//                 if(filesize($files[$i]) > 2*1024*1024) {
//                     $errors[] = 'avatars';
//                 }
//             }
//         }
//     }



//         if(isset($_FILES['avatars']) && !empty($_FILES['avatars']['name'][0])) {
//             $files = $_FILES['avatars']['tmp_name'];
//             for($i = 0; $i < count($files); $i++) {
//                 if(!empty($files[$i])) {
                   
//                     require_once 'view.php';
//                     exit;
//                 }
//             }
//         }
//     }
// }
