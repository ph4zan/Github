<?php
$months_length = [
    '01' => 31,
    '02' => 28,
    '03' => 31,
    '04' => 30,
    '05' => 31,
    '06' => 30,
    '07' => 31,
    '08' => 31,
    '09' => 30,
    '10' => 31,
    '11' => 30,
    '12' => 31
];
$week_day = [
    'Mon' => 1,
    'Tue' => 2,
    'Wed' => 3,
    'Thu' => 4,
    'Fri' => 5,
    'Sat' => 6,
    'Sun' => 7
];
$date = new DateTime();
$month = $date->format('m'); // номер выбранного месяца 
$numDays = $months_length[$month]; // количество дней выбранного месяца
$dateweek = new DateTime("01-{$month}-2025"); // первый день месяца
$monthStartDay = $dateweek->format('D'); // день недели первого дня месяца
$monthStartDay = $week_day[$monthStartDay]; // номер дня недели первого дня месяца
$resMonth = $date->format('F');
$res = '';
for($i=0; $i<6; $i++) {
    $res .= '<tr>';
    for($j=1; $j<=7; $j++) {
        if($i==0 && $j<$monthStartDay) {
                $res .=  '<td></td>';
                continue;
        }
        $current = $i*7+$j-$monthStartDay+1;
        if($current>$numDays) {
            continue;
        }
        if($j>=6) {
            $res .= "<td class=\"holliday\">$current</td>";
        } else {
            $res .=  "<td>$current</td>";
        }
    }
    $res .= '</tr>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .holliday {
            border: 1px solid red;
            color: red;
        }
    </style>
</head>
<body>
    <h2>
    <?= $resMonth .' '. 2025?>
    </h2>
<table border="1">
        <thead>
            <tr>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th class="holliday">Сб</th>
                <th class="holliday">Вс</th>
            </tr>
        </thead>
    <?= $res ?>
</body>
</html>