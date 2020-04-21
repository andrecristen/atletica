<?php


namespace Control\Form;


use Control\Admin\ImagemController;
use Model\Carteira;
use Model\Curso;
use Model\Imagem;
use Model\Pessoa;
use Model\Usuario;
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

    protected function beanModel()
    {
        $data = $this->getFormData();
        /** @var $curso Curso*/
        $cursoId = $data['curso'];
        if(isset($cursoId['id'])){
            $cursoId = $cursoId['id'];
        }
        $curso = $this->getEntityManager()->getRepository(Curso::class)->find($cursoId);
        if($this->getModel()->getId()){
            $imagem = $this->getModel()->getImagem();
            $pessoa = $this->getModel()->getUsuario()->getPessoa();
            $this->getFormBean()->beanModel($pessoa, $data['usuario']['pessoa']);
            $this->getEntityManager()->persist($pessoa);
            $this->getEntityManager()->flush($pessoa);
            unset($data['usuario']['pessoa']);
            $usuario = $this->getModel()->getUsuario();
            $this->getFormBean()->beanModel($usuario, $data['usuario']);
            $usuario->setPessoa($pessoa);
            $this->getEntityManager()->persist($usuario);
            $this->getModel()->setUsuario($usuario);
        }else{
            //Adicionando
            //Nova Pessoa
            $pessoa = new Pessoa();
            $usuario = new Usuario();
            $this->getFormBean()->beanModel($pessoa, $data['usuario']['pessoa']);
            $this->getEntityManager()->persist($pessoa);
            $this->getEntityManager()->flush($pessoa);
            unset($data['usuario']['pessoa']);
            //Novo usuário
            $this->getFormBean()->beanModel($usuario, $data['usuario']);
            $usuario->setPessoa($pessoa);
            $usuario->setTipo(Usuario::TIPO_ALUNO);
            $usuario->setSenha($pessoa->getDataNascimento()->format('dmY'));
            $usuario->setToken(md5(uniqid($usuario->getLogin(), true)));
            $this->getEntityManager()->persist($usuario);
            $this->getModel()->setUsuario($usuario);
            //Nova imagem
            $imagemController = new ImagemController();
            $imagem = $imagemController->novaImagem('arquivo', Imagem::TIPO_USUARIO, true);
        }
        $this->getModel()->setImagem($imagem);
        $this->getModel()->setCurso($curso);

        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }


    /**
     * @return Carteira
     */
    public function getModel()
    {
        return parent::getModel();
    }

}