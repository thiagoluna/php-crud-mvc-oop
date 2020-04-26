<?php

namespace CrudMvcOo\Controller;

use CrudMvcOo\Model\Post;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AboutController 
{
    public function index()
    {                  
        //usando Twig para passar os dados para a view
        $loader = new FilesystemLoader('./src/view');
        $twig = new Environment($loader);
        $template = $twig->load('about.html');

        //dados que serão enviados para a view
        $params = array();

        $content = $template->render($params);
        echo $content;
    }
}