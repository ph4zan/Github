<?php
session_start();
$_SESSION = [];
session_destroy();
header('Location: /github/php_blog/login.php');