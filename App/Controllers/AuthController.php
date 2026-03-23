<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    
    public function register($data)
    {
        // empty validation
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            $_SESSION['errors'] = ["All fields must be filled."];
            header("Location: index.php?action=register");
            exit();
        }

        // pass match
        if ($data['password'] !== $data['password_confirm']) {
            $_SESSION['errors'] = ["Passwords doesn't match."];
            header("Location: index.php?action=register");
            exit();
        }

        // email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'] = ["Invalid Email format."];
            header("Location: index.php?action=register");
            exit();
        }

        // email already registered
        $existingUser = $this->userModel->findByEmail($data['email']);
        if ($existingUser) {
            $_SESSION['errors'] = ["This email is currently exits."];
            header("Location: index.php?action=register");
            exit();
        }

        // creating user
        $result = $this->userModel->create(
            $data['username'],
            $data['email'],
            $data['password']
        );

        if ($result) {
            $_SESSION['success'] = "Regestration completed succsessfully! Now you can log in.";
            header("Location: index.php?action=login");
            exit();
        
        } else {
            $_SESSION['errors'] = ['Something went wrong with registration.'];
            header("Location: index.php?action=register");
            exit();
        }
    }
}