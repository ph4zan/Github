<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="text" id="city">
    <button id="send">Узнать погоду</button>
    <div id="info"></div>
    <script>
        const city = document.getElementById("city");
        const send = document.getElementById("send");
        const info = document.getElementById("info");
        send.addEventListener("click", async ()=> {
            cityVal = city.value
            try {
                const response = await fetch("https://wttr.in/"+cityVal);
                if(!response.ok) {
                    throw new Error(`Ошибка: ${response.status}`)
                }
                const data = await response.text();
                info.innerHTML = data;
            }
            catch(err) {
            console.log(err.message)
            }
        })





    </script>
</body>
</html>