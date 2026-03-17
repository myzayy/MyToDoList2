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

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchALL(PDO::FETCH_ASSOC); // FETCH_ASSOC takes only column names like keys

    }
}