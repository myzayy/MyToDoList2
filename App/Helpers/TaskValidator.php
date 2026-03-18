<?php

namespace App\Helpers;

class TaskValidator
{
    private $errors = [];

    public function validate(array $data)
    {
        if (!isset($data['title']) || empty(trim($data['title']))) {
            $this->errors[] = "Name of task can't be empty.";
        } elseif (mb_strlen($data['title']) > 128) {
            $this->errors[] = "Name of task is too long (Max lenght 128 characters).";
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}