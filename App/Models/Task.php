<?php

namespace App\Models;

use PDO;

class Task 
{
    private $db;

    private int $id;
    private string $title;
    private string $description;
    private bool $is_completed;
    private string $created_at;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    public function getAll($userId)
    {
        $query =  "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY is_completed ASC, created_at DESC";

        $stmt = $this->db->prepare($query); // make template from query
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC); // FETCH_ASSOC takes only column names like keys

    }

    public function create($title, $description = "", $userId)
    {
        $query = "INSERT INTO tasks (title, description, user_id) VALUES (:title, :description, :user_id)";
        
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId
        ]); // return true or false
    }

    public function delete($id)
    {
        $query = "DELETE FROM tasks WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function toggleStatus($id, $newStatus)
    {
        $query = "UPDATE tasks SET is_completed = :status WHERE id = :id";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":status", $newStatus);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}