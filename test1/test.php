<?php

class Person {
    private $name;
    private $age;
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function __toString()
    {
        return "Имя: ". $this->name ." Возраст: ". $this->age;
    }

  
}

$user = new Person('Иван', 25);
// echo $user;


class Car {
    private string $brand;
    private int $year;

    public function __construct($brand, $year) {
        $this->brand = $brand;
        $this->year = $year;

    }

    public function getInfo() {
        return $this->brand .", ". $this->year;
    }
}

$bmw = new Car('BMW', 2020);
// echo $bmw->getInfo();



class FileLogger {
    public function __construct() {
        echo "файл открыт";
    }

    public function __destruct() {
        echo "файл закрыт";
    }
}

function test() {
    $obj = new FileLogger;
}
// test();

class Counter {
    static private $count=0;

    public function increment() {
        self::$count++;
    }

    public function show() {
        return self::$count;
    }
}

$counter = new Counter;
$counter->increment();
$counter->increment();
// echo $counter->show();

class DynamicCaller {
    public function hello() {
        echo 'hello';
    }
    public function bye() {
        echo 'bye';
    }
}
$obj = new DynamicCaller;
$method = 'hello';
// $obj->$method();

class TaskRunner {
    public function run(callable $task) {
        return $task();
    }

    public function task() {
        echo "Метод объекта";
    }
}

// $taskRunner = new TaskRunner();

// $taskRunner->run([$taskRunner, 'task']);

class Profile {
    private $name = "John";
    public function getName() {
        echo $this->name;
    }
}

$profile = null;

$profile?->getName();