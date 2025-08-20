<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<form method="get" class="search-form">
  <input type="text" name="search" placeholder="Поиск..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
  <button type="submit">Найти</button>
</form>
    <div class="container">

<?php
$images = array_diff(scandir('images'), ['.', '..']);

if(isset($_GET['search'])) {
    if(in_array($_GET['search'], $images)) {
        $images = [$_GET['search']];
    }
}

foreach($images as $i) {
    echo "<div class=\"item\">";
    echo "<img width=250px height=250px src=\"images/".$i."\"></div>";
} 
?>
</div>
</body>
<html>