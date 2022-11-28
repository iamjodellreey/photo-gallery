<?php

class User extends DatabaseService
{
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $file;
    public $image;
    public $imageDir = "img";
    public $tmpPath;
    protected static $tableName = "users";
    protected static $tableFields = ['username', 'password', 'firstname', 'lastname', 'image'];

    public static function verifyUser($username, $password)
    {
        global $database;

        $username = $database->escapeString($username);
        $password = $database->escapeString($password);

        $sql = "SELECT * FROM " . self::$tableName . " WHERE ";
        $sql .= "username = '{$username}' AND ";
        $sql .= "password = '{$password}'";

        $result = self::getQuery($sql);

        return !empty($result) ? array_shift($result) : false;
    }

    public function checkImage()
    {
        $this->image = basename($this->file['name']);
        $this->tmpPath = $this->file['tmp_name'];

        return !empty($this->image && $this->tmpPath) ? true : false;
    }

    public function picturePath()
    {
        return $this->imageDir . DS . $this->image;
    }

    public function updateImage($userId, $imageName)
    {
        global $database;

        $this->id = $database->escapeString($userId);
        $this->image = $database->escapeString($imageName);

        $sql = "UPDATE " . self::$tableName;
        $sql .= " SET image= '{$this->image}'";
        $sql .= "WHERE id = {$this->id}";

        $database->query($sql);

       echo $this->picturePath();
    }
}
