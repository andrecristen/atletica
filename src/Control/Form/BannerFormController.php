<?php


namespace Control\Form;


use Control\Admin\ImagemController;
use Model\Configuracao;
use Model\Imagem;
use Pummax\Controller\BaseFormController;
use Pummax\Response\MessageResponse;
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

    public function inativar(){
        if($this->isPost()){
            try{
                $this->getEntityManager()->beginTransaction();
                $formData = $this->getFormData();
                $this->loadModelByKeys($this->formatRowResponse($formData), $this->getModel());
                $this->getModel()->setAtivo(false);
                $this->getEntityManager()->persist($this->getModel());
                $this->getEntityManager()->flush();
                $this->getEntityManager()->commit();
                $success = true;
                $message = 'Sucesso ao inativar registro';
            }catch (\Exception $exception){
                if($this->getEntityManager()->getConnection()->isTransactionActive()){
                    $this->getEntityManager()->rollback();
                }
                $success = false;
                $message = 'Erro ao inativar registro, tente novamente';
            }
            return new MessageResponse($success, $message);
        }else{
            return new MessageResponse(true, 'Deseja realmente inativar o registro selecionado?', MessageResponse::TIPO_CONFIRM);
        }
    }

    public function ativar(){
        if($this->isPost()){
            try{
                $this->getEntityManager()->beginTransaction();
                $formData = $this->getFormData();
                $this->loadModelByKeys($this->formatRowResponse($formData), $this->getModel());
                $this->getModel()->setAtivo(true);
                $this->getEntityManager()->persist($this->getModel());
                $this->getEntityManager()->flush();
                $this->getEntityManager()->commit();
                $success = true;
                $message = 'Sucesso ao ativar registro';
            }catch (\Exception $exception){
                if($this->getEntityManager()->getConnection()->isTransactionActive()){
                    $this->getEntityManager()->rollback();
                }
                $success = false;
                $message = 'Erro ao ativar registro, tente novamente';
            }
            return new MessageResponse($success, $message);
        }else{
            return new MessageResponse(true, 'Deseja realmente ativar o registro selecionado?', MessageResponse::TIPO_CONFIRM);
        }
    }

    protected function beanPost()
    {
        /** @var $configuracao Configuracao*/
        $configuracao = $this->getEntityManager()->getRepository(Configuracao::class)->findOneBy(['tipo' => Configuracao::TIPO_IMAGEM]);
        if(!$configuracao){
            $altura = null;
            $largura = null;
        }else{
            $configuracaoModel = $configuracao->getConfiguracaoModel();
            $altura = $configuracaoModel->getAlturaBanner();
            $largura = $configuracaoModel->getLarguraBanner();
        }
        $data = $this->getFormData();
        $imagemController = new ImagemController();
        $imagem = $imagemController->novaImagem('arquivo', Imagem::TIPO_BANNER, true, $altura, $largura);
        $imagem->setNome($data['nome']);
        $imagem->setTitulo($data['titulo']);
        $this->setModel($imagem);
    }

    /**
     * @return Imagem
     */
    public function getModel()
    {
        return parent::getModel(); // TODO: Change the autogenerated stub
    }

}