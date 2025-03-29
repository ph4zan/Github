<?php

require_once('../vendor/autoload.php');

$developer = new \App\Developer('Boris', '20', [5,8,10]);

$developer->setPosition('developer');
$developer->rest(); 