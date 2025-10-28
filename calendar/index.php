<?php
$date = new DateTime();
$countDays = $date->format('t'); // количество дней выбранного месяца
$month = $date->format('F');
$dateweek = new DateTime("01 {$month} 2025"); // первый день месяца
$monthStartDay = $dateweek->format('N'); // номер дня недели первого дня месяца
$date->modify('-1 month');
$countLastMonth = $date->format('t'); // количество дней прошлого месяца
$html = '';
for($i=0; $i<6; $i++) {
    $html .= '<tr>';
    for($j=1; $j<=7; $j++) {
        $classes = [];
        $current = $i*7+$j-$monthStartDay+1;
        if($i==0 && $j<$monthStartDay) {
            $current = $countLastMonth - $monthStartDay + $j+1;
            $classes[] = 'other-month';
        } elseif ($current>$countDays && $j == 1) {
            break;
        } else {
            if($current>$countDays) {
                $current -= $countDays;
                $classes[] = 'other-month';
            }
            if($j >= 6) {
                $classes[] = 'holliday';
            }
        }
        $html .= "<td class='" . implode(' ', $classes) . "'>$current</td>";
    }
    $html .= '</tr>';
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

        .other-month {
            opacity: 0.4;
        }
    </style>
</head>
<body>
    <h2>
    <?= $month .' '. 2025?>
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
    <?= $html ?>
</body>
</html>