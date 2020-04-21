<?php


namespace Repository;


use Model\Imagem;
use Pummax\Repository\BaseRepository;

class ImagemRepository extends BaseRepository
{

    public function createQueryConsulta()
    {
        $query = parent::createQueryConsulta();
        $query->andWhere('Imagem.tipo = :banner');
        $query->setParameter('banner', Imagem::TIPO_BANNER);
        return $query;
    }

}