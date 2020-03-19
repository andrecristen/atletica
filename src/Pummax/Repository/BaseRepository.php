<?php


namespace Pummax\Repository;


use Doctrine\ORM\EntityRepository;
use Pummax\Util\StringUtil;

abstract class BaseRepository extends EntityRepository
{
    protected $entityAlias;

    public function createQueryConsulta(){
        return $this->createQueryBuilder();
    }

    public function createQueryBuilder($alias = null, $indexBy = null)
    {
        if(!$alias){
            $alias = $this->getEntityAlias();
        }
        return parent::createQueryBuilder($alias, $indexBy);
    }

    public function getEntityAlias(){
        if(!$this->entityAlias){
            $parts = explode('\\', $this->_entityName);
            $entityName = end($parts);
            $parts = implode(' ', preg_split('/(?=[A-Z])/', $entityName));
            $this->entityAlias = StringUtil::toCamelCase($parts);
        }
        return $this->entityAlias;
    }



}