<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поздравляем с регистрацией!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: aliceblue;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg,rgb(0, 72, 58) 0%,rgb(0, 111, 111) 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;

        }
        
        h1 {
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .user-data {
            padding: 30px;
        }
        
        .data-item {
            margin-bottom: 20px;
            padding: 15px;
            background-color: rgb(247, 247, 247);
            border-radius: 8px;
            border-left: 5px solid #ff8a00;
            /* Добавленная тень */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .data-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.08);
        }
        
        .data-item:last-child {
            border-left-color: #ff8a00;
        }
        
        .data-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .data-value {
            color: #666;
            font-size: 1.2rem;
            word-break: break-all;
        }
        
        .gallery-section {
            padding: 0 30px 30px;
        }
        
        .gallery-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
        
        .gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-items: center;
        }
        
        .gallery-item {
            border-radius: 8px;
            width: 150px;
            height: 150px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .color {
            width: 24px;
            height: 24px;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            .data-value {
                font-size: 1rem;
            }
            
            .gallery {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            .gallery-item {
                width: 130px;
                height: 130px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Поздравляем!</h1>
        </div>
        
        <div class="user-data">
            <div class="data-item">
                <div class="data-label">Логин:</div>
                <div class="data-value" id="login-value"><?= $username?></div>
            </div>
            
            <div class="data-item">
                <div class="data-label">Электронная почта:</div>
                <div class="data-value" id="email-value"><?= $email?></div>
            </div>

            <div class="data-item">
                <div class="data-label">Пароль:</div>
                <div class="data-value" id="password-value"><?= $password?></div>
            </div>

            
            <div class="data-item">
                <div class="data-label">Выбранный цвет:</div>
                <div class="data-value" id="extra-value"><div class="color" style="background-color: <?= $color?>"></div></div>
            </div>
        </div>

        <div class="gallery-section">
            <div class="gallery-title">Ваши фотографии</div>
            <?php if (isset($imageNames) && !empty($imageNames)): ?>
                <div class="gallery" id="photo-gallery">
                    <?php foreach($imageNames as $image): ?>
                        <div class="gallery-item">
                            <img src="<?= "uploads/".$image ?>" alt="photo">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        
    </div>

</body>
</html>