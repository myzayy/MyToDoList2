<?php

session_start();

require_once '../vendor/autoload.php';

use App\Models\Task;
use Config\Database;
use App\Controllers\TaskController;

// C:\xampp\htdocs\MyToDoList2\config\Database.php

$db = new Database('localhost', 'root', '', 'todolist');
$connection = $db->connect();

$model = new Task($connection);
$controller = new TaskController($model);

// $model->create('Learn OOP', "Learn PDO");
if (isset($_POST['add_task'])) {
    $controller->add($_POST);
}

if (isset($_GET['delete'])) {
    $controller->remove($_GET['delete']);
}

if (isset($_GET['toggle']) && isset($_GET['status'])) {
    $controller->changeStatus($_GET['toggle'], $_GET['status']);
}

$tasks = $controller->index();

include '../views/TaskView.php';