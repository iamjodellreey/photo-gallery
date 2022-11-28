<?php
require_once("new_config.php");

class Database
{
    public $connection;

    public function __construct()
    {
        $this->openConnection();
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        $this->checkQuery($result);

        return $result;
    }

    public function escapeString($string)
    {
        return $this->connection->real_escape_string($string);
    }

    public function insertId()
    {
        return $this->connection->insert_id;
    }

    private function checkQuery($result): void
    {
        if (!$result) {
            die("Query Failed" . $this->connection->error);
        }
    }

    private function openConnection(): void
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_errno) {
            die("Database failed" . $this->connection->connect_error);
        }
    }
}

$database = new Database();
