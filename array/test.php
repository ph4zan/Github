<?php
$array1 = [1, 2, 3, 4, 5];
$array2 = [3, 4, 5, 6, 7];

$result = array_unique(array_filter(array_merge($array1, $array2), fn($value) => $value>2));
print_r($result);



$orders = [
    ['amount' => 100, 'status' => 'completed'],
    ['amount' => 200, 'status' => 'pending'],
    ['amount' => 150, 'status' => 'completed'],
    ['amount' => 50, 'status' => 'cancelled']
];
$result = array_reduce($orders, fn($acc, $n) => $n['status']=='completed' ? $acc+$n['amount']: $acc, 0);
echo $result;



$users = [
    ['id' => 1, 'email' => 'john@example.com'],
    ['id' => 2, 'email' => 'jane@example.com'],
    ['id' => 3, 'email' => 'bob@example.com']
];

$result = implode(',', array_column($users, 'email'));
echo $result;