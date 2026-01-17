<?php

/*
SQL-инъекции
Атака, при которой злоумышленник вставляет вредоносный SQL-код в запрос, получая доступ к БД.  


Пример sql-иньекции
Если в поле логина ввести:
' OR 1=1 --
Запрос станет таким:
SELECT * FROM users WHERE login = '' OR 1=1 -- ' AND password = '...';


Защита:
Используем подготовленные запросы (Prepared Statements)  
$stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute([':email' => $_POST['email']]);
$user = $stmt->fetch();




Межсайтовый скриптинг (XSS – Cross-Site Scripting)  

Атака, при которой злоумышленник вставляет вредоносный JavaScript в веб-страницу.  

Очистка данных перед выводом  
echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');

Примеры XSS
Простейший XSS (Reflected):
site.com/?name=<script>alert('XSS')</script>

Stored XSS:
$comment = $_POST['comment'];
mysqli_query($db, "INSERT INTO comments (text) VALUES ('$comment')");


DOM‑XSS:
Если на сайте есть такой JS:
document.getElementById('out').innerHTML =
  location.hash.substring(1);

site.com/#<img src=x onerror=alert('XSS')>


защита:
echo htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
Не использовать innerHTML

❌ ПЛОХО:
element.innerHTML = userInput;

✅ ХОРОШО:
element.textContent = userInput;


Валидация ввода (дополнительно)
if (!preg_match('/^[a-z0-9 ]+$/i', $name)) {
    die('Invalid input');
}


Межсайтовая подделка запросов (CSRF – Cross-Site Request Forgery)  
Злоумышленник заставляет пользователя выполнить нежелательный запрос от его имени 

Злоумышленник создаёт вредоносную страницу:
<form action="https://site.com/change-email" method="POST">
  <input type="hidden" name="email" value="hacker@mail.com">
</form>

<script>
  document.forms[0].submit();
</script>

Пользователь авторизован на site.com
Cookies сессии уже есть
Пользователь заходит на сайт злоумышленника
Форма автоматически отправляется
Браузер прикладывает cookies
Сервер думает:
👉 «Это запрос пользователя»
Email меняется
💥 CSRF сработал


защита:
CSRF‑токен
<input type="hidden" name="csrf_token" value="abc123">

if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403);
    exit('CSRF detected');
}



SameSite cookies
setcookie('PHPSESSID', $id, [
  'samesite' => 'Strict'
]);
*/
