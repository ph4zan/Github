<?php
header('Content-Type: application/json');
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$name = $data['name'];
$age= $data['age'];


if($name && $age) {
    $str = "Имя: $name; Возраст: $age";
    file_put_contents('users.txt', $str."\n" ,FILE_APPEND);
    echo json_encode([
       'message' => $str
    ]);
}
