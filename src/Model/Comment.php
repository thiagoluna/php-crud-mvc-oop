<?php

namespace CrudMvcOo\Model;

use CrudMvcOo\lib\Database\Connection;
use PDO;

class Comment 
{
    public static function findComments($idPost)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM comments WHERE post_id = :idPost ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':idPost', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $result = array();

        while ($row = $sql->fetchObject('CrudMvcOo\Model\Comment')) {
            $result[] = $row;
        }        

        return $result;
    }

    public static function insert($reqPost)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO comments (name, message, post_id) VALUES (:nom, :msg, :idp)";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':nom', $reqPost['nome']);
        $sql->bindValue(':msg', $reqPost['msg']);
        $sql->bindValue(':idp', $reqPost['id']);
        $sql->execute();

        if ($sql->rowCount()) {
            return true;
        }

        throw new Exception("Error to add comment.");
    }
}