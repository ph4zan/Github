<?php

namespace App;


class Developer extends Worker
{
    use HasRest;

    protected string $position;

    public function work()
    {
        print_r('im developing');
    }
}