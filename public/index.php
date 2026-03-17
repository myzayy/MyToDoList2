<?php

require_once '../vendor/autoload.php';

use Zaets\MyToDoList2\Config\Database;
// C:\xampp\htdocs\MyToDoList2\config\Database.php

$db = new Database('localhost', 'root', '', 'todolist');
$db->connect();