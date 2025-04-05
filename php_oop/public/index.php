<?php

require_once('../vendor/autoload.php');

$developer = new \App\Developer('Boris', '20', [5,8,10]);
$designer = new \App\Designer('Elena', '18', [5,8,10]);






$workers = [$developer, $designer];

// var_dump((string)$developer);


// foreach($workers as $worker) {
//     $worker->work();
//     echo '<br>';
// }




$salary = \App\Salary::count($developer->getHours());
\App\Salary::$totalHours +=100;




$salaryObj = new \App\Salary();

// var_dump($salary);


// var_dump($salaryObj::$totalHours);


//$developer = null;


// $developer->dqwfjejf('undefined method');

// \App\Developer::dwqtjek();

// print_r($developer->flwegrt);

// $developer->kfwthwn = 'fhtq';
// $developer->kfwthwn1 = 'fhtq1';
// $developer->kfwthwn2 = 'fhtq2';
// $value = $developer->kfwthwn1;
// var_dump($developer->getAttributes());

// var_dump(isset($developer->uwsj));

// unset($developer->uwsj);

// $str = serialize($developer);

// $object = unserialize($str);

// var_dump($object);

// $developer();

// $developer2 = clone $developer;

// var_dump($developer);

// var_dump(class_exists('App\Developer'));

// var_dump(get_class_methods($developer));
// var_dump(get_class($developer));
// var_dump(method_exists($developer, 'work'));