<?php


namespace Control\Form;


use Model\Usuario;
use Pummax\Controller\BaseFormController;
use View\Form\UsuarioForm;

class UsuarioFormController extends BaseFormController
{
    public function createInstanceView()
    {
        return new UsuarioForm();
    }

    public function createInstanceModel()
    {
        return new Usuario();
    }

}