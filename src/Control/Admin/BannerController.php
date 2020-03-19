<?php
/**
 * Criado: Fernando Cristen
 * Data: 18/11/2019
 * Hora: 21:48
 */

namespace Control\Admin;


use Pummax\Controller\BaseController;
use Pummax\Model\Resposta;
use Model\Imagem;
use View\Admin\BannerForm;

class BannerController extends BaseController
{
    public function index()
    {
        $fields = [
            'id' => '#',
            'titulo' => 'Titulo',
            'ativo' => 'Ativo',
        ];
        $acoesLinha = [
            'Editar' => 'editBanner',
            'Visualizar' => 'viewBanner',
            'Excluir' => 'deleteBanner',
        ];
        $acoes = [
            'Adicionar' => 'addBanner',
        ];
        $dados = $this->modeloParaGrid();
        $resposta = new Resposta($fields, $dados, $acoesLinha, $acoes);
        $resposta->getFormatoJSON();
    }

    public function modeloParaGrid()
    {
        $dados = [];
        /** @var $banners Imagem[] */
        $banners = $this->getEntityManager()->getRepository(Imagem::class)->findBy(['tipo' => Imagem::TIPO_BANNER]);
        foreach ($banners as $banner) {
            $ativo = 'Sim';
            if(!$banner->getAtivo()){
                $ativo = 'Não';
            }
            $dados[] = [
                'id' => $banner->getId(),
                'titulo' => $banner->getTitulo(),
                'ativo' => $ativo,
            ];
        }
        return $dados;
    }

    public function add(){
        if($this->isPost()){
            try{
                $imagemController = new ImagemController();
                $imagemUpload = $imagemController->novaImagem('upload', Imagem::TIPO_BANNER);
                $imagemUpload->setNome($this->getDataParam('nome'));
                $imagemUpload->setTitulo($this->getDataParam('titulo'));
                $imagemUpload->setAtivo($this->getDataParam('ativo'));
                $this->getEntityManager()->persist($imagemUpload);
                $this->getEntityManager()->flush();
                $this->redirectPage("/admin");
            }catch (\Exception $exception){
                $this->redirectPage("/admin");
            }
        }else{
            $view = new BannerForm('/addBanner');
            $view->getFormatoJSON();
        }
    }

    public function delete(){
        try{
            $banner = $this->getEntityManager()->getRepository(Imagem::class)->find($this->getResquestParam('id'));
            if($banner) {
                $this->getEntityManager()->remove($banner);
                $this->getEntityManager()->flush();
                echo json_encode(['message' => 'Excluido entidade #'.$this->getResquestParam('id')]) ;
                return;
            }
        }catch (\Exception $exception){
            echo json_encode(['message' => 'Erro ao excluir entidade, tente novamente']);
        }
    }

    public function edit(){
        if($this->isPost()){
            try{
                /** @var $banner Imagem*/
                $banner = $this->getEntityManager()->getRepository(Imagem::class)->find($this->getDataParam('id'));
                $banner->setNome($this->getDataParam('nome'));
                $banner->setTitulo($this->getDataParam('titulo'));
                $ativo = $this->getDataParam('ativo');
                if(!$ativo){
                    $ativo = false;
                }
                $banner->setAtivo($ativo);
                $this->getEntityManager()->persist($banner);
                $this->getEntityManager()->flush();
                $this->redirectPage("/admin");
            }catch (\Exception $exception){
                echo json_encode(['message' => $exception->getMessage()]);
                //$this->redirectPage("/admin");
            }
        }else{
            $banner = $this->getEntityManager()->getRepository(Imagem::class)->find($this->getResquestParam('id'));
            $view = new BannerForm('/editBanner', false, true);
            $view->setDados($this->modeloParaForm($banner));
            $view->getFormatoJSON();
        }
    }

    public function view(){
        $imagem = $this->getEntityManager()->getRepository(Imagem::class)->find($this->getResquestParam('id'));
        $view = new BannerForm('/viewBanner', true);
        $view->setDados($this->modeloParaForm($imagem));
        $view->getFormatoJSON();
    }

    public function modeloParaForm(Imagem $imagem){
        $dado = [
            'id' => $imagem->getId(),
            'titulo' =>  $imagem->getTitulo(),
            'nome' =>  $imagem->getNome(),
            'ativo' =>  $imagem->getAtivo(),
        ];
        return $dado;
    }
}