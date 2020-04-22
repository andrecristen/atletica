<?php


namespace Control\Form;


use Control\Admin\ImagemController;
use Model\Carteira;
use Model\Curso;
use Model\Imagem;
use Model\Pessoa;
use Model\Usuario;
use Pummax\Configuration\DataBase;
use Pummax\Controller\BaseFormController;
use Pummax\View\Email\Templates;
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
        $imagemController = new ImagemController();
        $isAdd = false;
        if($this->getModel()->getId()){
            $imagem = $this->getModel()->getImagem();
            $pessoa = $this->getModel()->getUsuario()->getPessoa();
            $imagemNova = $imagemController->novaImagem('arquivo', Imagem::TIPO_USUARIO, true);
            if($imagemNova){
                $imagem = $imagemNova;
            }
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
            $isAdd = true;
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
            $usuario->setToken(Usuario::generateToken($usuario));
            $this->getEntityManager()->persist($usuario);
            $this->getModel()->setUsuario($usuario);
            //Nova imagem
            $imagem = $imagemController->novaImagem('arquivo', Imagem::TIPO_USUARIO, true);
        }
        $this->getModel()->setImagem($imagem);
        $this->getModel()->setCurso($curso);
        $this->getFormBean()->beanModel($this->getModel(), ['dataVencimento' => $data['dataVencimento']]);
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
        if($isAdd){
            $remetente = new \Pummax\Mail\Email('smtp.gmail.com', 587, 'tls','email', 'senha', DataBase::NOME_SISTEMA);
            $email = new \Pummax\Mail\MessageEmail('Conta Criada '.DataBase::NOME_SISTEMA, Templates::criacaoConta($usuario->getPessoa()->getNome(), DataBase::NOME_SISTEMA, "Sua data de nascimento", DataBase::URL_SITE), $usuario->getLogin());
            $sender = new \Pummax\Mail\SendEmail();
            $sender->send($remetente, $email);
        }
    }


    /**
     * @return Carteira
     */
    public function getModel()
    {
        return parent::getModel();
    }

}