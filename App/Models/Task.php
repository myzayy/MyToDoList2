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
    
    public function getAll()
    {
        $query =  "SELECT * FROM tasks";

        $stmt = $this->db->prepare($query); // make template from query
        $stmt->execute();

        return $stmt->fetchALL(PDO::FETCH_ASSOC); // FETCH_ASSOC takes only column names like keys

    }

    public function create($title, $description = "")
    {
        $query = "INSERT INTO tasks (title, description) VALUES (:title, :description)";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':title', $title); // give data
        $stmt->bindParam(':description', $description);

        return $stmt->execute(); // return true or false
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