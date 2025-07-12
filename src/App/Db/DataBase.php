<?php

namespace App\Db;

class DataBase
{
    public static function getConnection()
    {
        $dsn = "mysql:host=localhost:3306;dbname=tp_recettes;charset=utf8";
        $db = new \PDO($dsn, 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
