<?php

class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];
    
    public function __construct($arr, $sanitize = true) {
        $this->loadFromArray($arr, $sanitize);
    }

    public function loadFromArray($arr,  $sanitize = true) {
        if ($arr) {
            // $conn = Database::getConnection();
            foreach($arr as $key => $value) {
                // Validação para impedir INJECTIONS e input de HTML em campos.
                $cleanValue = $value;
                if ($sanitize && isset($cleanValue)) {
                    $cleanValue = strip_tags(trim($cleanValue)); // Evitar código HTML
                    $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES); // Evitar código HTML
                    // $cleanValue = mysqli_real_escape_string($conn, $cleanValue); //Evitar SQL Injection -- Foi comentado pois já existe PrepareStatement
                }
                $this->$key = $cleanValue; 
            }
            // $conn->close();
        }
    }

    public function __get($key) {
        return $this->values[$key];
    }

    public function __set($key, $value) {
        $this->values[$key] = $value;
    }

    public static function get($filters = [], $columns = '*') {
        $objects = [];
        $result = static::getResultSetFromSelect($filters, $columns);
        if($result) {
            $class = get_called_class();
            while($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getOne($filters = [], $columns = '*') {
        $class = get_called_class();
        $result = static::getResultSetFromSelect($filters, $columns);
        return $result ? new $class($result->fetch_assoc()) : null;
    }

    public static function getResultSetFromSelect($filters = [], $columns = '*') {
        $sql = "SELECT ${columns} FROM " . static::$tableName . static::getFilters($filters);
        
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0) {
            return null;
        } else {
            return $result;
        }
    }


    public static function getCount($filters = []) {
        $result = static::getResultSetFromSelect(
            $filters, 'count(*) as count');
        return $result->fetch_assoc()['count'];
    }

    private static function getFilters($filters) {
        $sql = "";
        if (count($filters) > 0) {
            $sql = " WHERE 1 = 1";
            foreach($filters as $column => $value) {
                if($column == 'raw') { //Significa que já virá um SQL puro, sem precisar formatar!
                    $sql .= " AND {$value}";
                } else {
                    $sql .= " AND ${column} = " . static::getFormatedValue($value);
                }
            }
        }
        return $sql;
    }

    private static function getFormatedValue($value) {
        if (is_null($value)) {
            return "NULL";
        } elseif (gettype($value) === 'string') {
            return "'${value}'";
        } else {
            return $value;
        }
    }

    public function insert() {
        $sql = "INSERT INTO " . static::$tableName . " ("
            . implode(",", static::$columns) . ") VALUES (";
        foreach (static::$columns as $col) {
            $sql .= static::getFormatedValue($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ')';
        $id = Database::executeSQL($sql);
        $this->id = $id;
    }

    public function update () {
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach(static::$columns as $col) {
            $sql .= "${col} = " . static::getFormatedValue($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ' ';
        $sql .= "WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }

    public function delete() {
        static::deleteById($this->id);
    }

    public static function deleteById ($id) {
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = {$id}";
        Database::executeSQL($sql);
    }
}