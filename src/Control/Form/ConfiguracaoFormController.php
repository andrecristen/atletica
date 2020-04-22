<?php


namespace Control\Form;


use Model\Configuracao;
use Pummax\Controller\BaseFormController;
use View\Form\ConfiguracaoForm;

class ConfiguracaoFormController extends BaseFormController
{

    public function createInstanceModel()
    {
        return new Configuracao();
    }

    public function createInstanceView()
    {
        return new ConfiguracaoForm();
    }
}