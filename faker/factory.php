<?php
include_once 'functions.php';


function CreateUserFactory():Closure {
    $names['f'] = file('lists/female_names_rus.txt');
    $names['m'] = file('lists/male_names_rus.txt');
    $surnames['m'] = file('lists/male_surnames_rus.txt');
    $surnames['f'] = file('lists/female_surnames_rus.txt');
    $lang = ['Python','JavaScript','Java','Typescript','C#','PHP','C++','C','Ruby','Golang','HTML','SQL'];
    return function() use ($names, $surnames, $lang) {
        static $id = 0;
        $sex = rand(0,1) ? 'm' : 'f';
        $user['id'] = ++$id;
        shuffle($names[$sex]);
        shuffle($surnames[$sex]);
        $user['name'] = trim($names[$sex][0]) .' '. $surnames[$sex][0];
        $user['age'] = rand(18,40);
        $course_keys = array_rand($lang, 2);
        foreach ($course_keys as $key) {
                $course[]= $lang[$key];
            }
        $user['course'] = $course;
        return $user;
    };
}
$factory = CreateUserFactory();

$user1 = $factory();
$user2 = $factory();
$user3 = $factory();

print_r($user1);
print_r($user2);
print_r($user3);
