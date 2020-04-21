<?php


namespace Control\Form;


use Model\Pessoa;
use Model\Usuario;
use Pummax\Controller\BaseFormController;
use View\Form\UsuarioForm;

class UsuarioFormController extends BaseFormController
{
    public function createInstanceView()
    {
        return new UsuarioForm();
    }

    protected function addPost()
    {
        $this->beanPost();
        $this->getModel()->setTipo(Usuario::TIPO_ADMIN);
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }

    protected function beanPost()
    {
        $formData = $this->getFormData();
        $isAdd = false;
        if($this->getModel()->getId()){
            $pessoa = $this->getModel()->getPessoa();
        }else{
            $pessoa = new Pessoa();
            $isAdd = true;
        }
        $this->getFormBean()->beanModel($pessoa, $formData['pessoa']);
        unset($formData['pessoa']);
        $this->getEntityManager()->persist($pessoa);
        $this->getModel()->setPessoa($pessoa);
        $this->getFormBean()->beanModel($this->getModel(), $formData);
        if($isAdd){
            $this->getModel()->setToken(Usuario::generateToken($this->getModel()));
        }
        $this->getEntityManager()->persist($this->getModel());
    }

    public function createInstanceModel()
    {
        return new Usuario();
    }

    /**
     * @return Usuario
     */
    public function getModel()
    {
        return parent::getModel();
    }

}