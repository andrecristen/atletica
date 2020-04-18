<?php


namespace Control\Form;


use Model\Carteira;
use Pummax\Controller\BaseFormController;
use View\Form\CarteiraForm;

class CarteiraFormController extends BaseFormController
{
    public function createInstanceView()
    {
        return new CarteiraForm();
    }

    public function createInstanceModel()
    {
        return new Carteira();
    }

}