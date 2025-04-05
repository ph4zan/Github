<?php

require_once '../vendor/autoload.php';

class Node {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class SinglyLinkedList {
    public $head;
    public function __construct() {
        $this->head = null;
    }

    public function append($data) {
        $new_node = new Node($data);
        if(!$this->head) {
            $this->head = $new_node;
            return;
        }
        $last_node = $this->head;
        fb($last_node);

        while($last_node->next !== null) {
            $last_node = $last_node->next;
        }
        $last_node->next = $new_node;
        fb($last_node);
    }

    public function print_list() {
        $current_node = $this->head;
        while($current_node !== null) {
            echo $current_node->data . " -> ";
            $current_node = $current_node->next;
        }
        echo "None\n";
    }

}

$sll = new SinglyLinkedList();
$sll->append(1);
$sll->append(2);
$sll->append(3);
$sll->append(4);
$sll->print_list();