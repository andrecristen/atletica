<?php


namespace Control\Form;


use Control\Admin\ImagemController;
use Model\Configuracao;
use Model\Endereco;
use Model\Imagem;
use Model\Parceiro;
use Pummax\Controller\BaseFormController;
use Pummax\Response\MessageResponse;
use View\Form\ParceiroForm;

class ParceiroFormController extends BaseFormController
{
    public function createInstanceView()
    {
        return new ParceiroForm();
    }

    public function createInstanceModel()
    {
        return new Parceiro();
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

    protected function beanModel()
    {
        $data = $this->getFormData();
        $imagemController = new ImagemController();
        /** @var $configuracao Configuracao*/
        $configuracao = $this->getEntityManager()->getRepository(Configuracao::class)->findOneBy(['tipo' => Configuracao::TIPO_IMAGEM]);
        if(!$configuracao){
            $altura = null;
            $largura = null;
        }else{
            $configuracaoModel = $configuracao->getConfiguracaoModel();
            $altura = $configuracaoModel->getAlturaParceiro();
            $largura = $configuracaoModel->getLarguraParceiro();
        }
        if($this->getModel()->getId()){
            $endereco = $this->getModel()->getEndereco();
            $imagem = $this->getModel()->getImagem();
            $imagemNova = $imagemController->novaImagem('arquivo', Imagem::TIPO_PARCEIRO, true, $altura, $largura);
            if($imagemNova){
                $imagem = $imagemNova;
            }
        }else{
            $endereco = new Endereco();
            $imagem = $imagemController->novaImagem('arquivo', Imagem::TIPO_PARCEIRO, true, $altura, $largura);
        }
        $this->getFormBean()->beanModel($endereco, $data['endereco']);
        $this->getEntityManager()->persist($endereco);
        $this->getEntityManager()->persist($imagem);
        unset($data['endereco']);
        unset($data['imagem']);
        $this->getFormBean()->beanModel($this->getModel(), $data);
        $this->getModel()->setImagem($imagem);
        $this->getModel()->setEndereco($endereco);
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }

    /**
     * @return Parceiro
     */
    public function getModel()
    {
        return parent::getModel();
    }
}