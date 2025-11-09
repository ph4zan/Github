<?php

class Router {
    private $routes=[];
    private $class;
    private $method;
    public function add($uri, $handler) {
        $this->routes[$uri] = $handler;
    }
    public function dispatch($uri) {
        foreach($this->routes as $key => $val) {
            if($uri===$key) {
                $this->class = $val[0];
                $this->method = $val[1];
            }
        }
            $obj = new $this->class;
            $obj->{$this->method}();
    }
}

class AdminController {
    public function sayHello() {
        echo "Привет Админ!";
    }
}

class UserController {
    public function sayHello() {
        echo "Привет Пользователь!";
    }
}


$router = new Router;
$router->add('/admin',['AdminController', 'sayHello']);
$router->add('/',['UserController', 'sayHello']);
$router->dispatch('/');