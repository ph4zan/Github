<?php
function normalizeToYear(DateTime $d, int $year): DateTime {
    $month = (int)$d->format('m');
    $day = (int)$d->format('d');

    // Обработка 29 февраля: если в нужном году нет 29 февраля, используем 28 февраля
    if ($month === 2 && $day === 29) {
        if (!checkdate(2, 29, $year)) {
            $day = 28;
        }
    }

    $d->setDate($year, $month, $day);
   // $d->setTime(0, 0, 0);
    return $d;
}


function getDaysUntilBirthday(string $birthday) {
    // Входная дата может содержать год рождения, например '2005-09-15'
    $birth = new DateTime($birthday);
    $today = new DateTime();
    $today->setTime(0, 0, 0);

    // День/месяц этого года
    $nextBirthday = normalizeToYear($birth, (int)$today->format('Y'));

    // Если уже прошло в этом году — берем следующий год
    if ($nextBirthday < $today) {
        $nextBirthday = normalizeToYear($birth, (int)$today->format('Y') + 1);
    }

    $diff = $today->diff($nextBirthday);
   return (int) $diff->days;
}

echo "Введите год рожднения :";
$year = (int)trim(fgets(STDIN));
echo "Введите месяц рожднения :";
$month = (int)trim(fgets(STDIN));
echo "Введите день рожднения :";
$day = (int)trim(fgets(STDIN));
echo "до дня рождения осталось ",getDaysUntilBirthday("{$year}-{$month}-{$day}");
