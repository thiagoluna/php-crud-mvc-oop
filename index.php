<?php

require "./vendor/autoload.php";

use CrudMvcOo\Router\Router;

$template = file_get_contents("./src/Template/estrutura.html");

ob_start();
    $core = (new Router())->start($_GET);
    $return = ob_get_contents();
ob_end_clean();

$tplPronto = str_replace('{{area_dinamica}}', $return, $template);
echo $tplPronto;