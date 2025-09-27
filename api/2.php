<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="save_user.php">
        <input type="text" id="name">
        <input type="text" id="age">
        <input type="submit" value="Отправить" id="send">
        <div id="result"><div>
    </form>
    <script>
        const name = document.getElementById("name");
        const age = document.getElementById("age");
        const send = document.getElementById("send");
        const resDiv = document.getElementById("result");
        send.addEventListener("click", async ()=> {
            event.preventDefault();
            const nameVal = name.value;
            const ageVal = age.value;
            const data = {
                name: nameVal,
                age: ageVal
            }
        try {
            const response = await fetch('save_user.php', {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)       
        });
        if (!response.ok) {
            throw new Error(`Ошибка: ${response.status}`);
        }
        const res = await response.json();
        if(res.message) {
            
        }
        resDiv.textContent = res.message;
        name.value = '';
        age.value = '';
        } catch(err) {
            console.log(err.message)
        }
        })
    </script>
</body>
</html>