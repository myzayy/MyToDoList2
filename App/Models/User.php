<?php

namespace App\Models;

use PDO;

class User
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' =>$hashedPassword
        ]);
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    public function getAllUsers()
    {
        $query = "SELECT id, username, email, is_admin, created_at FROM users ORDER BY id DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
}