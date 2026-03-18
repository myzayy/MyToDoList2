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
    public function index()
    {
        $tasks = $this->taskModel->getAll();
        return $tasks;
    }

    // add new task
    public function add($data)
    {
        $validator = new TaskValidator();
        
        if ($validator->validate($data)) {
            $this->taskModel->create($data['title'], $data['description'] ?? "");
            header("Location: index.php"); // redirect back after adding
            exit();
        } else {

            header("Location: index.php?error=invalid_data");
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