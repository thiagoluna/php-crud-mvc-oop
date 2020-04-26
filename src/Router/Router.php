<?php

namespace CrudMvcOo\Router;

class Router
{
    const URL = "CrudMvcOo\Controller\\";

    public function start($urlGet)
    {
        //var_dump($urlGet);
        if (isset($urlGet['action'])) {
            $action = $urlGet['action'];
        } else {
            $action = 'index';
        }


        //var_dump($urlGet['page']);
        if (isset($urlGet['page'])) {
            $controller =  self::URL . ucfirst($urlGet['page'].'Controller');
        } else {
            $controller =  self::URL . "HomeController";
        }

        if(!class_exists($controller)) {
            $controller =  self::URL . "ErrorController";
        }

        if (isset($urlGet['id']) && $urlGet['id'] != null) {
           $id = $urlGet['id'];
        } else {
            $id = null;
        }

        call_user_func_array(array(new $controller, $action), array('id' => $id));
    }
}