<?php

namespace App\Controllers;

use App\Helpers\TaskValidator;
use App\Models\Task;

class TaskController
{
    private $taskModel;

    public function __construct(Task $model)
    {
        $this->taskModel = $model;
    }

    // print main page
    public function index($userId, $filter)
    {
        $userId = $_SESSION['user_id'] ?? 0;

        $tasks = $this->taskModel->getAll($userId, $filter);
        return $tasks;
    }

    // add new task
    public function add($data)
    {
        $userId = $_SESSION['user_id'] ?? null; 
        
        // php level user validation
        if (!$userId) {
            $_SESSION['errors'] = ["Please log in first."];
            header("Location: index.php?action=login");
            exit();
        }

        $validator = new TaskValidator();
        
        if ($validator->validate($data)) {
            $this->taskModel->create($data['title'], $data['description'] ?? "", $userId);
            header("Location: index.php"); // redirect back after adding
            exit();
        } else {
            // save errors array in session
            $_SESSION['errors'] = $validator->getErrors();

            header("Location: index.php");
            exit();
        }

        
    }

    public function remove($id)
    {
        $this->taskModel->delete($id);

        header("Location: index.php");
        exit();
    }

    public function changeStatus($id, $newStatus) 
    {
        $this->taskModel->toggleStatus($id, $newStatus);

        header("Location: index.php");
        exit();
    }
}