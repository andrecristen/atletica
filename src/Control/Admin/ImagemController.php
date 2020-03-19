<?php

namespace Control\Admin;


use Pummax\Controller\BaseController;
use Model\Imagem;

class ImagemController extends BaseController
{
    public function novaImagem($fileName, $tipo = Imagem::TIPO_USUARIO, $persist = true){
        $nome = $_FILES[$fileName]['tmp_name'];
        $nomeAll = $_FILES[$fileName]['name'];
        $date = new \DateTime();
        $path = '/img/'.$date->format('dmYHis').$nomeAll;
        $target = __DIR__ .'/../../../utils'.$path;
        move_uploaded_file($nome, $target);
        $imagem = new Imagem();
        $imagem->setTitulo($nomeAll);
        $imagem->setNome($nomeAll);
        $imagem->setPatch($path);
        $imagem->setTipo($tipo);
        $imagem->setAtivo(true);
        if($persist){
            $this->getEntityManager()->persist($imagem);
        }
        return $imagem;
    }
}