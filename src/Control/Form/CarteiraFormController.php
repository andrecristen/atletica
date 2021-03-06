<?php


namespace Control\Form;


use Control\Admin\ImagemController;
use Model\Carteira;
use Model\Configuracao;
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
        /** @var $configuracao Configuracao*/
        $configuracao = $this->getEntityManager()->getRepository(Configuracao::class)->findOneBy(['tipo' => Configuracao::TIPO_IMAGEM]);
        if(!$configuracao){
            $altura = null;
            $largura = null;
        }else{
            $configuracaoModel = $configuracao->getConfiguracaoModel();
            $altura = $configuracaoModel->getAlturaCarteira();
            $largura = $configuracaoModel->getLarguraCarteira();
        }
        if($this->getModel()->getId()){
            $imagem = $this->getModel()->getImagem();
            $pessoa = $this->getModel()->getUsuario()->getPessoa();
            $imagemNova = $imagemController->novaImagem('arquivo', Imagem::TIPO_USUARIO, true, $altura, $largura);
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
            $imagem = $imagemController->novaImagem('arquivo', Imagem::TIPO_USUARIO, true, $altura, $largura);
        }
        $this->getModel()->setImagem($imagem);
        $this->getModel()->setCurso($curso);
        $this->getFormBean()->beanModel($this->getModel(), ['dataVencimento' => $data['dataVencimento']]);
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
        if($isAdd){
            $this->enviaEmail($usuario);
        }
    }

    /**
     * Quando uma nova conta é criada envia o email para ela.
     *
     * @param Usuario $usuario
     * @throws \Exception
     */
    private function enviaEmail(Usuario $usuario){
        /** @var $configuracao Configuracao*/
        $configuracao = $this->getEntityManager()->getRepository(Configuracao::class)->findOneBy(['tipo' => Configuracao::TIPO_EMAIL]);
        if(!$configuracao){
            throw new \Exception("Não localizado configuração do tipo E-mail para envio. Por favor certifique-se de configurar antes.");
        }
        $configuracaoModel = $configuracao->getConfiguracaoModel();
        $remetente = new \Pummax\Mail\Email($configuracaoModel->getHost(), $configuracaoModel->getPort(), $configuracaoModel->getSmtpSecure(),$configuracaoModel->getUsername(), $configuracaoModel->getSenha(), $configuracaoModel->getFromName());
        $email = new \Pummax\Mail\MessageEmail('Conta Criada '.DataBase::NOME_SISTEMA, Templates::criacaoConta($usuario->getPessoa()->getNome(), DataBase::NOME_SISTEMA, "Sua data de nascimento", DataBase::URL_SITE), $usuario->getLogin());
        $sender = new \Pummax\Mail\SendEmail();
        $sender->send($remetente, $email);
    }


    /**
     * @return Carteira
     */
    public function getModel()
    {
        return parent::getModel();
    }

}