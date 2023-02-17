<?php

class DatabaseService
{
    public function searchUser($keyword, $field)
    {

        $sql = "SELECT * FROM " . static::$tableName . " WHERE ";
        $sql .= "{$field} LIKE '%{$keyword}%' ";

        $result = self::getQuery($sql);

        return $result;
    }

    public function create()
    {
        global $database;

        $propertyArray = $this->sanitizeProperties();

        $sql  = "INSERT INTO " . static::$tableName . "(" . implode(",", array_keys($propertyArray)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($propertyArray)) . "')";

        if (static::doQuery($sql)) {
            $this->id = $database->insertId();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;

        $propertyArray = $this->sanitizeProperties();

        $pairKeysValues = [];

        foreach ($propertyArray as $key => $value) {
            $pairKeysValues[] = "{$key}='{$value}'";
        }

        $sql  = "UPDATE " . static::$tableName . " SET ";
        $sql .= implode(",", $pairKeysValues);
        $sql .= " WHERE id= " . $database->escapeString($this->id);
        static::doQuery($sql);

        return ($database->connection->affected_rows == 1) ? true : false;
    }

    public function delete()
    {
        global $database;

        $sql = "DELETE FROM  " . static::$tableName . " WHERE id=$this->id";
        static::doQuery($sql);

        return ($database->connection->affected_rows == 1) ? true : false;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //This is just to make sure that the object has a property exist the same as the key of result.
    public function hasKey($key)
    {
        $objectProperty = get_object_vars($this);
        return array_key_exists($key, $objectProperty);
    }

    public static function getAll(): array
    {
        return static::getQuery("SELECT * FROM " . static::$tableName . " ");
    }

    public static function getById(int $id)
    {
        $result = static::getQuery("SELECT * FROM " . static::$tableName . " WHERE id=$id");
        return !empty($result) ? array_shift($result) : false;
    }

    //NOTE: Added 01/13, apply this on counting all data in a specific table
    public static function countAll(){
        return count(static::$tableName::getAll());
    }

    public static function getQuery(string $sql): array
    {
        $result = static::doQuery($sql);
        $resultArray = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $resultArray[] = static::arrayToObject($row);
        }

        return $resultArray;
    }

    protected function properties()
    {
        $properties = [];

        foreach (static::$tableFields as $field) {
            //TODO: Logic is wrong it can cause incorrect fields when logging in, due to password encryption
            // if ($field == 'password') {
            //     $securePassword  = password_hash($this->$field, PASSWORD_BCRYPT);
            //     $properties[$field] = $securePassword;
            // } else {
            //     $properties[$field] = $this->$field;
            // }
            $properties[$field] = $this->$field;
        }

        return $properties;
    }

    protected function sanitizeProperties()
    {
        global $database;

        $sanitizedProperties = [];

        foreach ($this->properties() as $key => $value) {
            $sanitizedProperties[$key] = $database->escapeString($value);
        }

        return $sanitizedProperties;
    }

    protected static function arrayToObject($result)
    {
        $childClass = get_called_class();
        $object = new $childClass;

        foreach ($result as $key => $value) {
            if ($object->hasKey($key)) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    protected static function doQuery($sql)
    {
        global $database;
        $result = $database->query($sql);

        return $result;
    }
}
