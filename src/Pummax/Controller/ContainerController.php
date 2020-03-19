<?php

namespace Pummax\Controller;


class ContainerController
{
    public static function newController($controller)
    {
        $objContoller = str_replace('::', '\\', $controller);
        return new $objContoller;
    }


    public static function pageNotFound()
    {
        if(file_exists(__DIR__ . "/../View/404.phtml")){
            return require_once __DIR__ . "/../View/404.phtml";
        }else{
            echo "Erro 404: Pagina nao encontrada!";
        }
    }

    public static function pageAcessoNegado()
    {
        if(file_exists(__DIR__ . "/../View/negado.phtml")){
            return require_once __DIR__ . "/../View/negado.phtml";
        }else{
            echo "Acesso negado";
        }
    }

}