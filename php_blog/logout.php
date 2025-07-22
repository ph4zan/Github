<?php
session_start();
$_SESSION = [];
session_destroy();
header('Location: /php_blog/login.php');