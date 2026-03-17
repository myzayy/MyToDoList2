<?php

require_once '../vendor/autoload.php';

use App\Models\Task;
use Config\Database;
// C:\xampp\htdocs\MyToDoList2\config\Database.php

$db = new Database('localhost', 'root', '', 'todolist');

$connection = $db->connect();

$taskModel = new Task($connection);
$tasks = $taskModel->getAll();

var_dump($tasks);