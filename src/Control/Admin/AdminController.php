<?php

namespace Control\Admin;


use Pummax\Controller\BaseController;
use Pummax\Controller\ContainerController;
use Pummax\View\Facilitador;

class AdminController extends BaseController
{
    public function run(){
        if($this->getUserSession()){
            Facilitador::createTemplateAdmin();
        }else{
            ContainerController::pageAcessoNegado();
        }
    }
}