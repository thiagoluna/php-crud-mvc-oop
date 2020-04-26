<?php


namespace CrudMvcOo\Controller;

use CrudMvcOo\Model\Post;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminController
{
    public function index()
    {
        try {
            //Como o método all é static, não precisa instanciar sua classe
            $colectPosts = Post::all();

            //usando Twig para passar os dados para a view
            $loader = new FilesystemLoader('./src/view');
            $twig = new Environment($loader);
            $template = $twig->load('admin.html');

            //dados que serão enviados para a view
            $params = array();
            $params['posts'] = $colectPosts;

            $content = $template->render($params);
            echo $content;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create()
    {
        //usando Twig para passar os dados para a view
        $loader = new FilesystemLoader('./src/view');
        $twig = new Environment($loader);
        $template = $twig->load('create.html');

        //dados que serão enviados para a view
        $params = array();

        $content = $template->render($params);
        echo $content;
    }

    public function insert()
    {
        //var_dump($_POST);
        try {
            Post::insert($_POST);
            echo '<script>alert("Post Added.");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=admin&action=index"</script>';
        } catch (\Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=admin&action=create"</script>';
        }
    }

    public function change($params)
    {
        try {
            $post = Post::findById($params);

            //var_dump($post);

            //usando Twig para passar os dados para a view
            $loader = new FilesystemLoader('./src/view');
            $twig = new Environment($loader);
            $template = $twig->load('update.html');

            //dados que serão enviados para a view
            $params = array();
            $params['id'] = $post->id;
            $params['title'] = $post->title;
            $params['content'] = $post->content;

            $content = $template->render($params);
            echo $content;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        //var_dump($colectPosts);
    }

    public static function update()
    {
        //var_dump($_POST);
        try {
            Post::update($_POST);
            echo '<script>alert("Post Updated.");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=admin&action=index"</script>';
        } catch (\Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=admin&action=change&id=' . $_POST['id'] . '"</script>';
        }
    }

    public function delete($params)
    {
        //var_dump($_POST);
        try {
            Post::delete($params);
            echo '<script>alert("Post Deleted.");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=admin&action=index"</script>';
        } catch (\Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/crud_mvc_oo/?page=admin&action=index"</script>';
        }
    }
}