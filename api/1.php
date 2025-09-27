<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="text" id="text">
    <button id = "send">Отправить</button>
    <div id="result"><div>

    <script>
        const text = document.getElementById("text");
        const send = document.getElementById("send");
        const res = document.getElementById("result");
        send.addEventListener("click", async ()=>{
        const value = text.value;
        try {
            const response = await fetch('hello.php?name='+value, {
            method: "GET", 
            headers: {
                "Content-Type": "application/json"
            }
        });
        if (!response.ok) {
            throw new Error(`Ошибка: ${response.status}`);
        }
        const data = await response.json();
        res.textContent = (data.message);
        } catch(err) {
            res.textContent = err.message
        }
        })





    </script>
</body>
</html>