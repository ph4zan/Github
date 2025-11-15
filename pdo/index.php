<?php 
class DB  {

    static $db;
    static $instance;

    protected function __construct($dsn,$username,$password,$options) {
        self::$instance = new PDO($dsn,$username,$password,$options);
    }
    
    public static function getInstance($dsn,$username,$password,$options) {
        if(self::$instance instanceof PDO){
            return self::$instance;
        } else {
            if(self::$db instanceof self){
                exit('Ошибка работы БД!') ;
            } else {
                self::$db = new self($dsn, $username, $password, $options);
                return self::$instance;
            }
        }
    }
}
    $dsn = "mysql:host=localhost;dbname=menagerie;charset=utf8";
    $user = "root";
    $pass = "";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
$pdo = DB::getInstance($dsn, $user, $pass, $opt);

$stmt = $pdo->prepare("SELECT * FROM animals WHERE id = ?");
$stmt->execute([1]);
$user = $stmt->fetch();

print_r($user);