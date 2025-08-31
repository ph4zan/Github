<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">

</head>
<body>
<a href="?"><button type="button" class="btn btn-primary">Главная</button></a>
<a href="?action=add"><button type="button" class="btn btn-primary">Добавить фото</button></a>

<?php
$host = "localhost"; 
$user = "root";
$pass = "";
$dbname = "gallery";

$conn = new mysqli($host, $user, $pass, $dbname);
$images = array_diff(scandir('images'), ['.', '..']);
$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
$views = [];
while ($row = $result->fetch_assoc()) {
    if(in_array($row['photo'], $images)) {
        $views []= $row;
    }
}
// if(isset($_GET['search'])) {
//     if(in_array($_GET['search'], $images)) {
//         $images = [$_GET['search']];
//     }
// }

if(isset($_GET['action']) && $_GET['action']=='add') {
    require_once 'add.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $photo = $_FILES['photo']['name'];
        $targetDir = __DIR__ . '/images/';
        $targetFile = $targetDir . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
        $date = date('Y-m-d',rand(time()-60*60*24*365*5, time()));
        $conn->query("INSERT INTO posts (title, photo, date) VALUES ('$title', '$photo', '$date')");
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
    exit;
}
?>

<form method="post">
  <select name="sort" onchange="this.form.submit()" class="form-select" aria-label="Default select example">
    <option value="default" <?php if (empty($_POST['sort'])) echo 'selected'; ?>>Сортировка по умолчанию</option>
    <option value="title" <?php if (isset($_POST['sort']) && $_POST['sort'] === 'title') echo 'selected'; ?>>
      Сортировка по Названию
    </option>
    <option value="date" <?php if (isset($_POST['sort']) && $_POST['sort'] === 'date') echo 'selected'; ?>>
      Сортировка по Дате
    </option>
  </select>
</form>
<div class="container">

<?php
if(empty($_GET['action'])) {
    if(isset($_POST['sort']) && $_POST['sort']==='title') {
        $result = $conn->query("SELECT * FROM posts ORDER BY title");
        $views = [];
        while ($row = $result->fetch_assoc()) {
            if(in_array($row['photo'], $images)) {
                $views []= $row;
            }
        }
    } elseif(isset($_POST['sort']) && $_POST['sort']==='date') {
        $result = $conn->query("SELECT * FROM posts ORDER BY date DESC");
        $views = [];
        while ($row = $result->fetch_assoc()) {
            if(in_array($row['photo'], $images)) {
                $views []= $row;
            }
        }
    }
    foreach($views as $i) {
        echo "<div class=\"item\">";
        echo "<img width=250px height=250px src=\"images/".$i['photo']."\">";
        echo "<p>".$i['title']. "</p><p>Дата: ".$i['date']."</p></div>";
        
    } 
}
?>

</div>
</body>
<html>