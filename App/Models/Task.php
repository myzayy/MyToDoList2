<?php

namespace App\Models;

use PDO;

class Task 
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    public function getAll($userId, $filter = 'all')
    {
        $query =  "SELECT * FROM tasks WHERE user_id = :user_id";

        if ($filter === 'active') {
            $query .= " AND is_completed = 0";
        } elseif ($filter === 'completed') {
            $query .= " AND is_completed = 1";
        }

        $query .= " ORDER BY is_completed ASC, created_at DESC";

        $stmt = $this->db->prepare($query); // make template from query
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC); // FETCH_ASSOC turns result as array

    }

    public function getById($id, $userId)
    {
        $query = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'id' => $id,
            'user_id' =>$userId
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

        return $stmt->execute(['id' => $id]);
    }

    public function toggleStatus($id, $newStatus)
    {
        $query = "UPDATE tasks SET is_completed = :status WHERE id = :id";
        
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'status' => $newStatus,
            'id' => $id
        ]);
    }
    
    // delete tasks from user
    public function deleteByUserId($userId)
    {
        $query = "DELETE FROM tasks WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);
        
        return $stmt->execute(['user_id' => $userId]);
    }

    // update task
    public function update($id, $title, $userId)
    {
        $query = "UPDATE tasks SET title = :title WHERE id = :id AND user_id = :user_id";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'title' => $title,
            'id' => $id,
            'user_id' => $userId
        ]);
    }

    // task status completed
    public function getStatus($userId)
    {
        $query = "SELECT COUNT(*) as total, SUM(is_completed) as completed FROM tasks WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}