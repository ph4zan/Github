<?php
header('Content-Type: application/json');
$response['list'] = '';
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$name = $data['name']??'';
$age= $data['age']??'';
$errors = '';
if(mb_strlen($name)<3) {
    $errors .= "Имя должно содержать не менее 3 символов! ";
}
if ($age < 16 || $age > 80) {
    $errors .= "Возраст должен быть от 16 до 80! ";
}
if(empty($errors)) {
    $str = "$name;$age";
    file_put_contents('users.txt', $str . "\n", FILE_APPEND);
    $response['info'] = "Пользователь успешно добавлен";
} else {
    $response['info'] = $errors;
}   

if(file_exists('users.txt')) {
    $users = file_get_contents('users.txt');
    $users = explode("\n", $users);
    array_pop($users);
    $list = '<ul>';
    foreach($users as $user) {
        $part = explode(';', $user);
        $list .= "<li>Имя: {$part[0]}; Возраст: {$part[1]};</li>";
    }
    $list .= '</ul>';
    $response['list'] = $list;
}

echo json_encode($response);