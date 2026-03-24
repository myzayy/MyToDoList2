<?php

session_start();

require_once '../vendor/autoload.php';

use App\Models\Task;
use Config\Database;
use App\Controllers\TaskController;
use App\Models\User;
use App\Controllers\AuthController;

// C:\xampp\htdocs\MyToDoList2\config\Database.php

$db = new Database('localhost', 'root', '', 'todolist');
$connection = $db->connect();

$taskModel = new Task($connection);
$controller = new TaskController($taskModel);

$userModel = new User($connection);
$authController = new AuthController($userModel);

$action = $_GET['action'] ?? 'home'; // initialize which action wants user

switch ($action) {
    case 'register':
        if (isset($_POST['do_register'])) {
            $authController->register($_POST);
        }

        include '../views/auth/register.php';
        break;
    case 'login':
        if (isset($_POST['do_login'])) {
            $authController->login($_POST);
        }
        include '../views/auth/login.php';
        break;
    case 'admin':
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            $_SESSION['errors'] = ["Access denied! You're not administrator."];
            header("Location: index.php");
            exit();
        }

        if (isset($_GET['delete_user'])) {
            $userIdToDelete = $_GET['delete_user'];

            if ($userIdToDelete == $_SESSION['user_id']) {
                $_SESSION['errors'] = ["You can't delete administrator!"];
            } else {

                $taskModel->deleteByUserId($userIdToDelete);

                $userModel->delete($userIdToDelete);
                $_SESSION['success'] = "User have been deleted.";

            }
            header("Location: index.php?action=admin");
            exit();
        }

        $allUsers = $userModel->getAllUsers();

        include '../views/layout/header.php';
        include '../views/admin/users.php';
        include '../views/layout/footer.php';
        break;

    case 'logout':
        $authController->logout();
        break;
    case 'home':
    
    default:
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
        include '../views/layout/header.php';
        include '../views/TaskView.php';
        include '../views/layout/footer.php';

}

