<?php


namespace Repository;


use Pummax\Repository\BaseRepository;

class CarteiraRepository extends BaseRepository
{

    public function createQueryConsulta(){
        $alias = $this->getEntityAlias();
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->addSelect($alias);
        $query->addSelect('Curso');
        $query->addSelect('Usuario');
        $query->addSelect('Pessoa');
        $query->from($this->getEntityName(), $alias, null);
        $query->join('Carteira.curso', 'Curso');
        $query->join('Carteira.usuario', 'Usuario');
        $query->join('Usuario.pessoa', 'Pessoa');
        return $query;
    }

}