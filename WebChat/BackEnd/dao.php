<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/16
 * Time: 14:19
 * Content：数据库交互
 */
class dao
{
    public $tableName;
    public $conditions;
    public $connect;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->connect = new mysqli("localhost", "root", "wdwlwdmx110Jst", "Webchat");
        if ($this->connect->connect_error) {
            die("Could not connect!");
        }
    }

    public function Insert($objects, $conditions)
    {
        if (!empty($conditions)) {
            $sql = "INSERT INTO $this->tableName ($objects) VALUES ($conditions)";
            $result = mysqli_query($this->connect, $sql);
            return $result;
        }
        return;
    }

    public function Query($objects, $conditions)
    {
        if (empty($conditions)) {
            $conditions = ' 1=1';
        }
        $sql = "SELECT $objects FROM $this->tableName WHERE $conditions";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}