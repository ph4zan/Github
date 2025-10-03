<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input type="text" id="name" placeholder="Имя">
<input type="number" id="age" placeholder="Возраст">
<button id="load">добавить пользователя</button> 
<div id="info"></div>
<ul id="list-users"></ul>

<script>
    const name = document.getElementById("name");
    const age = document.getElementById("age");
    const loadBtn = document.getElementById("load");
    const info = document.getElementById("info");
    const list = document.getElementById("list-users");
    loadBtn.addEventListener("click", async ()=>{
        const nameVal = name.value;
        const ageVal = age.value;
        const data = {
                name: nameVal,
                age: ageVal
            }
        try {
        const response = await fetch("reg_user.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)       

        });
        if(!response.ok) {
            throw new Error(`Ошибка: ${response.status}`)
        }
        const res = await response.json();
        list.innerHTML = res.list;
        info.textContent = res.info;
        age.value = '';
        if(res.info==="Пользователь успешно добавлен") {
            name.value = '';
        }
    } 

    catch(err) {
        console.log(err.message)
    }
    })
</script>
</body>
</html>