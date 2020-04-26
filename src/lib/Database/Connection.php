<?php


namespace CrudMvcOo\lib\Database;

use PDO;

abstract class Connection
{
    private static $conn;

    public static function getConn()
    {
        if(self::$conn == null) {
            $conexao = array("localhost", "root", "", "crud_mvc_oo");
            $options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            self::$conn = $pdo = new PDO("mysql: host=$conexao[0]; dbname=$conexao[3];", $conexao[1], $conexao[2], $options);
        }

        return self::$conn;
    }
}