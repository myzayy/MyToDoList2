<?php

namespace Config;

use PDO;
use PDOException;

class Database 
{
    private $host;
    private $password;
    private $dbname;
    private $username;
    public $conn;

    public function __construct($host, $username, $password, $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect()
    {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8";

            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // say PDO to throw exceptions if they exist

            // echo "Connected Successfully!";

        } catch (PDOException $exception) { // PDOException catch only database errors
            echo "Connection Error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    

}