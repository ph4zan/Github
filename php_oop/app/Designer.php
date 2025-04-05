<?php

namespace App;


class Designer extends Worker
{
    use HasRest;

    protected string $position;

    public function work()
    {
        print_r('im designing');
    }
}