<?php

namespace App;

class Salary
{
    static public int $totalHours;


    static public function count(array $hours)
    {
        self::$totalHours = array_sum($hours);
        return self::$totalHours * 2000;
    } 
}