<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        exit('CSRF token mismatch');
    }

    $title = sanitize($_POST['title']);
    $content = sanitize($_POST['content']);


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            // Создаём уникальное имя файла, чтобы не перезаписать
            $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
            $uploadFilePath = $uploadDir . $fileName;
    
            // Перемещаем файл из временной папки
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
                // Всё успешно — сохраняем относительный путь в БД (например 'uploads/имя_файла')
                $imagePath = 'uploads/' . $fileName;
            } else {
                exit('Ошибка при загрузке файла');
            }
        } else {
            // Если файл не загрузили — можно оставить пустым или поставить null
            $imagePath = null;
        }
    

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image, author_id) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$title, $content, $imagePath, $_SESSION['user_id']]);
        echo 'Пост создан ';
    } catch (PDOException $e) {
        exit('Пользователь уже существует');
    }
} else {
    include 'templates/add.php';
}