<?php

// Front Controller -- single point of entry, initializes the system and routes requests

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

// Routing

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

        $userId = $_SESSION['user_id'] ?? 0;
        $editTask = null;
        $stats = $taskModel->getStatus($userId);
        $filter = $_GET['filter'] ?? 'all';
        // $tasks = $taskModel->getAll($userId, $filter);
        
        // if pressed edit
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $editTask = $taskModel->getById($_GET['id'], $userId);
        }

        // pressed save in edit form
        if (isset($_POST['update_task'])) {
            $controller->update($_POST['task_id'], $_POST['title']);
        }

        if (isset($_POST['add_task'])) {
            $controller->add($_POST);
        }

        if (isset($_GET['delete'])) {
            $controller->remove($_GET['delete']);
        }

        // button set as completed or not
        if (isset($_GET['toggle']) && isset($_GET['status'])) {
            $controller->changeStatus($_GET['toggle'], $_GET['status']);
        }

        $tasks = $controller->index($userId, $filter);
        include '../views/layout/header.php';
        include '../views/TaskView.php';
        include '../views/layout/footer.php';

}

