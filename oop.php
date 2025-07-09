<?php
/*
Уровень 3: Композиция (дополнительно, если время есть)
Задача:

    Создай класс Course, который представляет учебный курс:

        private string $name (название курса),

        private Teacher $teacher (преподаватель курса),

        private array $students (массив объектов Student).

        Конструктор принимает $name и $teacher.

        Методы:

            addStudent(Student $student) – добавляет студента в курс.

            getCourseInfo() – возвращает строку с информацией о курсе, преподавателе и количестве студентов.
*/

class Person {
    public string $name;

    protected int $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function introduce() {
        return "Меня зовут очень хорошо {$this->name}, мне {$this->age} лет";
    }
}

class Teacher extends Person {
    private array $subjects;

    public function __construct($name, $age, $subjects)
    {
        parent::__construct($name, $age);
        $this->subjects = $subjects;
    }

    public function introduce() {
        return parent::introduce().", я преподаю: ". implode(',', $this->subjects);
    }

    public function teach($subject) {
        if(in_array($subject, $this->subjects)) {
            return "Я преподаю {$subject}\n";
        } else {
            return "Я не могу преподавать {$subject}\n";
        }
    }
}


class Student extends Person {
    private string $course;

    public function __construct($name, $age, $course)
    {
        parent::__construct($name, $age);
        $this->course = $course;
    }

    public function introduce() {
        return parent::introduce().", я учусь на курсе {$this->course}.";
    }
}


class Course {
    private string $name;

    private Teacher $teacher;

    private array $students;


    public function __construct($name, $teacher)
    {
        $this->name = $name;
        $this->teacher = $teacher;
    }

    public function addStudent(Student $student) {
        $this->students []= $student;
    }

    public function getCourseInfo() {
        return "Курс: $this->name
Преподаватель: ". $this->teacher->name ."
Количество студентов: " . count($this->students);
    }
}
/*
Проверка:
php

$teacher = new Teacher("Мария", 35, ["ООП"]);
$course = new Course("Продвинутый PHP", $teacher);

$student1 = new Student("Иван", 22, "Продвинутый PHP");
$student2 = new Student("Ольга", 23, "Продвинутый PHP");

$course->addStudent($student1);
$course->addStudent($student2);

echo $course->getCourseInfo();
 Вывод:
   Курс: Продвинутый PHP
   Преподаватель: Мария
   Количество студентов: 2
*/


$teacher = new Teacher("Мария", 35, ["ООП"]);
$course = new Course("Продвинутый PHP", $teacher);

$student1 = new Student("Иван", 22, "Продвинутый PHP");
$student2 = new Student("Ольга", 23, "Продвинутый PHP");

$course->addStudent($student1);
$course->addStudent($student2);

echo $course->getCourseInfo();