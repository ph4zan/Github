<?php

include_once 'functions.php';

$female_names = file('lists/female_names_rus.txt');
$male_names = file('lists/male_names_rus.txt');
$male_surnames = file('lists/male_surnames_rus.txt');
$lang = ['Python','JavaScript','Java','Typescript','C#','PHP','C++','C','Ruby','Golang','HTML','SQL'];

function faker() {
    global $female_names;
    global $male_names;
    global $male_surnames;
    global $lang;
    static $id = 0;
    $names = rand(0,1) ? $male_names : $female_names;
    $name = trim($names[rand(0,count($names)-1)]);
    $surname = $male_surnames[rand(0,count($male_surnames)-1)];
    if ($names == $female_names) {
        $surname = toFeminineSurname($surname);
    }
    $course_keys = array_rand($lang, 2);
    foreach ($course_keys as $key) {
        $course[]= $lang[$key];
    }
    return [
        'id' => ++$id,
        'name' => $name . ' ' . $surname,
        'age' => rand(18,60),
        'course' => $course
    ];
}

print_r(faker());