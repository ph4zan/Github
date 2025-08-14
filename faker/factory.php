<?php
include_once 'functions.php';


function CreateUserFactory():Closure {
    $names['f'] = file('lists/female_names_rus.txt');
    $names['m'] = file('lists/male_names_rus.txt');
    $surnames['m'] = file('lists/male_surnames_rus.txt');
    $surnames['f'] = file('lists/female_surnames_rus.txt');
    $lang = ['Python','JavaScript','Java','Typescript','C#','PHP','C++','C','Ruby','Golang','HTML','SQL'];
    return function(int $num) use ($names, $surnames, $lang) {
        static $id = 0;
        for($i=0;$i<$num;$i++) {
            $j = $i + $id;
            $sex = rand(0,1) ? 'm' : 'f';
            $user['id'] = $j;
        //    shuffle($names[$sex]);
        //    shuffle($surnames[$sex]);
            $user['name'] = trim($names[$sex][0]) .' '. trim($surnames[$sex][0]);
            $user['age'] = rand(18,40);
            $course = [];
            $course_keys = array_rand($lang, 2);
            foreach ($course_keys as $key) {
                    $course[]= $lang[$key];
                }
            $user['course'] = $course;
            $users[] = $user;
        }
        $id+= $num;
        return $users;
    };
}
$factory = CreateUserFactory();

$users = $factory(50);

print_r($users);
