<?php


namespace App\Models;

use App\Components\DB;


abstract class Model
{
    protected static $connection = null;
    protected static $table = null;
    protected $attributes = [];

    public static function setConnection() {
        static::$connection = DB::getConnection();
    }

    public static function getTable()
    {
        return static::$table;
    }

    public function __get($property)
    {
        return (isset($this->attributes[$property])) ? $this->attributes[$property] : null;
    }

    public function __set($key, $value)
    {
        $value = htmlspecialchars(addslashes(trim($value)));
        $this->attributes[$key] = $value;
    }

    public static function find($id)
    {
        static::setConnection();
        $result = static::$connection->query("SELECT * FROM " . static::$table . " WHERE id = " . $id);
        $row = $result->fetch();
        if (!$row)
            return null;
        $activeRecord = new static;
        foreach ($row as $key => $value) {
            $activeRecord->$key = $value;
        }
        return $activeRecord;
    }

    public function save()
    {
        static::setConnection();
        $fields = "(";
        $values = "(";
        if (empty($this->attributes))
            throw new \Exception("Error: Model - " . static::class . " does not any attribute");
        foreach ($this->attributes as $field => $value) {
            $fields .= $field  . ",";
            $values .= ":" . $field . ",";
        }
        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);
        $fields .= ")";
        $values .= ")";
        $sql = "INSERT INTO " . static::$table . $fields . " VALUES " . $values;
        $stmt  = static::$connection->prepare($sql);
        $result = $stmt->execute($this->attributes);
        if ($result) {
            $this->id = static::$connection->lastInsertId();
            return true;
        } else {
            return false;
        }
    }


}