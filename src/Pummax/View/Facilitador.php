<?php

namespace Pummax\View;


use Pummax\Controller\BaseController;
use Pummax\Model\Mensagem;

class Facilitador
{
    public static function createTemplateAdmin(){
        $mensagemSuccess = Mensagem::getMessageSuccess();
        $mensagemErro = Mensagem::getMessageErro();
        $baseControl = new BaseController();
        $usuario = $baseControl->getUserModelSession();
        $usuario = $usuario->getPessoa()->getNome();
        $cache = "?v=20-04-2020-1";
        include 'admin.phtml';
    }

    public static function createMenuSite(){
        $usuario = self::getUsuarioNome();
        include 'menu-site.phtml';
    }

    public static function getUsuarioNome(){
        $baseControl = new BaseController();
        $usuario = $baseControl->getUserModelSession();
        if(!$usuario){
            return null;
        }
        return $usuario->getPessoa()->getNome();
    }

    public static function createFooterSite(){
        include 'rodape-site.phtml';
    }
}