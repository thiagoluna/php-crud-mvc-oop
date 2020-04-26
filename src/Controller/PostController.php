<?php

namespace CrudMvcOo\Controller;

use CrudMvcOo\Model\Comment;
use CrudMvcOo\Model\Post;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PostController
{
    public function index($params)
    {
        try {            
            $post = Post::findById($params);

            //var_dump($post);

            //usando Twig para passar os dados para a view
            $loader = new FilesystemLoader('./src/view');
            $twig = new Environment($loader);
            $template = $twig->load('single.html');

            //dados que serão enviados para a view
            $params = array();
            $params['id'] = $post->id;
            $params['title'] = $post->title;
            $params['content'] = $post->content;
            $params['comments'] = $post->comments;

            $content = $template->render($params);
            echo $content;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        //var_dump($colectPosts);
    }

    public function addComent()
    {
        try {
            Comment::insert($_POST);

            header('Location: http://localhost/crud_mvc_oo/?page=post&id='.$_POST['id']);
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=post&id='.$_POST['id'].'"</script>';
        }

    }
}