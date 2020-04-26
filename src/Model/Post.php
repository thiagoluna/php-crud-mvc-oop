<?php


namespace CrudMvcOo\Model;

use CrudMvcOo\lib\Database\Connection;
use PDO;

class Post
{
    //metodo static pode ser usado sem instanciar sua classe
    public static function all()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->execute();

        $res = array();

        while ($row = $sql->fetchObject('CrudMvcOo\Model\Post')) {
            $res[] = $row;
        }

        if (!$res) {
            throw new \Exception("Não foi encontrado nenhum registro");
        }

        return $res;
    }

    public static function findById($id)
    {        
        $conn = Connection::getConn();

        $sql = "SELECT * FROM posts WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $res = $sql->fetchObject('CrudMvcOo\Model\Post');
        
        if (!$res) {
            throw new \Exception("Não foi encontrado nenhum registro");
        } else {
            $res->comments = Comment::findComments($res->id);             
        }      

        return $res;
    }

    public static function insert($post)
    {
        //var_dump($post);
        if (empty($post['title']) OR empty($post['content'])) {
            throw new \Exception("Preencha todos os campos");

            return false;
        }

        $conn = Connection::getConn();

        $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':title', $post['title']);
        $sql->bindValue(':content', $post['content']);
        $res = $sql->execute();

        if ($res == 0) {
            throw new \Exception("Error to Add Post");
            return false;
        }

        return true;
    }

    public static function update($post)
    {
        //var_dump($post);
        if (empty($post['title']) OR empty($post['content'])) {
            throw new \Exception("Preencha todos os campos");

            return false;
        }

        $conn = Connection::getConn();

        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $post['id'], PDO::PARAM_INT);
        $sql->bindValue(':title', $post['title']);
        $sql->bindValue(':content', $post['content']);
        $res = $sql->execute();

        if ($res == 0) {
            throw new \Exception("Error to Update Post");
            return false;
        }

        return true;
    }

    public static function delete($id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM posts WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $res = $sql->execute();

        if ($res == 0) {
            throw new \Exception("Error to Delete Post");
            return false;
        }

        return true;

    }
}