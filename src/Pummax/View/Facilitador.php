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
        $usuario = $baseControl->getUserSession();
        $usuario = $usuario[0]['usu_login'];
        $cache = "?v=19-03-2020-1";
        include 'admin.phtml';
    }

    public static function createMenuSite(){
        $baseController = new BaseController();
        include 'menu-site.phtml';
    }

    public static function createFooterSite(){
        include 'rodape-site.phtml';
    }
}