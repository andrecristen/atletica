<?php


namespace Control\Form;


use Model\Curso;
use Pummax\Controller\BaseFormController;
use View\Form\CursoForm;

class CursoFormController extends BaseFormController
{

    public function createInstanceView()
    {
        return new CursoForm();
    }


    public function createInstanceModel()
    {
        return new Curso();
    }

}