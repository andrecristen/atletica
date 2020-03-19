<?php


namespace Control\Form;


use Model\Imagem;
use Pummax\Controller\BaseFormController;
use View\Form\BannerForm;

class BannerFormController extends BaseFormController
{

    public function createInstanceView()
    {
        return new BannerForm();
    }


    public function createInstanceModel()
    {
        return new Imagem();
    }

}