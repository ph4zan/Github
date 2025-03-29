<?php


namespace App;

class Visitor
{
    use HasRest;
    public string $name;
    public int $age;
    public array $hours;


    public function visit()
    {
        print_r('im visiting');
    }



}