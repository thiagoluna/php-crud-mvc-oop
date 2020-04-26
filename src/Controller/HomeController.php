<?php

namespace CrudMvcOo\Controller;

use CrudMvcOo\Model\Post;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController
{
    public function index()
    {
        try {
            //Como o método all é static, não precisa instanciar sua classe
            $colectPosts = Post::all();

            //usando Twig para passar os dados para a view
            $loader = new FilesystemLoader('./src/view');
            $twig = new Environment($loader);
            $template = $twig->load('home.html');

            //dados que serão enviados para a view
            $params = array();
            $params['posts'] = $colectPosts;

            $content = $template->render($params);
            echo $content;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        //var_dump($colectPosts);
    }
}