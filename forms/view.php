

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация завершена</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
        }
        .card h1 {
            color: #4CAF50;
        }
        .info {
            margin: 10px 0;
            text-align: left;
        }
        .info span {
            font-weight: bold;
        }
        .avatar {
            margin: 15px 0;
            width: 100px;
            height: 100px;
            background-color: <?= $_POST['color'] ?>;
            border-radius: 50%;
            display: inline-block;
            line-height: 100px;
            color: white;
            font-size: 36px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #4a90e2;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Готово!</h1>

        <div class="avatar"><?= strtoupper($_POST['username'][0]) ?></div>

        <div class="info"><span>Логин:</span> <?= htmlspecialchars($_POST['username']) ?></div>
        <div class="info"><span>Почта:</span> <?= htmlspecialchars($_POST['email']) ?></div>
        <div class="info"><span>Пароль:</span> <?= htmlspecialchars($_POST['password']) ?></div>
        <div class="info"><span>Пол:</span> <?= $_POST['gender'] == 'm' ? 'Мужской' : 'Женский' ?></div>
        <div class="info"><span>Интересы:</span> <?= implode(', ', $_POST['interest']) ?></div>
        <a href="">Назад</a>
    </div>
    
</body>
</html>