<?php

namespace App\Controllers;

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
    public function add($title, $description)
    {
        if (!empty($title)) {
            $this->taskModel->create($title, $description);
        }

        header("Location: index.php"); // redirect back after adding
    }

    public function remove($id)
    {
        $this->taskModel->delete($id);

        header("Location: index.php");
        exit();
    }
}