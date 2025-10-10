<?php
$products = [
    ['name' => 'Телефон', 'price' => 3500, 'quantity' => 5],
    ['name' => 'Ноутбук', 'price' => 12000, 'quantity' => 2],
    ['name' => 'Наушники', 'price' => 800, 'quantity' => 10],
];
$total = 0;
$list = '<table border="1"><tr>';

for($i=0; $i<count($products); $i++) {
    $products[$i]['sum'] = $products[$i]["price"] * $products[$i]["quantity"];
    if(!$i) {
        foreach($products[$i] as $k=>$v) {
            $list.= "<th>$k</th>";
        }
    }
    $list.="</tr>";
    
    $list .= "<tr>";
    foreach ($products[$i] as $par) {
        $list.= "<td>".$par."</td>";

    }
    $list.="</tr>";
    $total += $products[$i]['sum'];
}
$list .= "<tfoot>
        <tr>
            <td colspan=\"3\"><strong>Итого:</strong></td>
            <td><strong>{$total}</strong></td>
        </tr>
    </tfoot>";
$list .="</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?= $list ?>
</body>
</html>