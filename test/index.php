<?php

function processItems(...$items): array {
    if (count($items) === 1 && is_array($items[0])) {
        $items = $items[0];
    }

    return array_map(function($item) {
        if (is_callable($item)) {
            return $item(2);
        }
        if (is_string($item)) {
            return mb_strtoupper($item);
        }
        if (is_int($item)) {
            return $item * 2;
        }
        if (is_float($item)) {
            return round($item, 2);
        }
        if (is_array($item)) {
            return count($item);
        }
        if (is_object($item)) {
            return get_object_vars($item);
        }
        if (is_bool($item)) {
            return $item ? 'true' : 'false';
        }
        if (is_null($item)) {
            return 'NULL';
        }
        if (is_resource($item)) {
            return get_resource_type($item);
        }

        return $item;
    }, $items);
}


function square($n) {
    return $n *$n;
}

$handle = fopen("test.txt", "r");

// Вызов 1: Отдельные аргументы
$result1 = processItems(true, null, $handle, 'square');
print_r($result1);