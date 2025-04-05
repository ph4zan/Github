<?php


namespace App;

abstract class Worker implements WorkerInterface
{
    private string $name;
    private int $age;
    private array $hours;

    private string $position;

    private int $positionInFuture;

    public function __construct($name, $age, $hours) 
    {
        $this->name = $name;
        $this->age = $age;
        $this->hours = $hours;
    }


    abstract public function work();



    public function setName($value)
    {
        $this->name = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setAge($value)
    {
        $this->age = $value;
    }

    public function getAge(): string
    {
        return $this->age;
    }


    public function setHours($value)
    {
        $this->hours = $value;
    }

    public function getHours()
    {
        return $this->hours;
    }


    public function setPosition($value)
    {
        $this->position = $value;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}