<?php


namespace Pummax\Controller;


use Doctrine\ORM\QueryBuilder;
use Pummax\Util\StringUtil;

class FilterGridController
{

    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * @var array
     */
    protected $filters;

    /**
     * FilterGridController constructor.
     * @param QueryBuilder $query
     * @param array $filters
     */
    public function __construct(QueryBuilder $query, array $filters)
    {
        $this->query = $query;
        $this->filters = $filters;
    }

    public function adicionaCondicoes(){
        foreach ($this->getFilters() as $filter){
            $this->addCondicao($filter);
        }
        return $this->getQuery();
    }

    public function addCondicao($filter){
        if(!isset($filter['operador'])){
            return;
        }
        $paramName = ':param'.$filter['tableName'].$filter['content'];
        $paramValue = $filter['value'];
        $paramType = null;
        $likeOperator = [
          'like', 'not like'
        ];
        if(in_array($filter['operador'], $likeOperator)){
            $paramValue = '%'.StringUtil::removeAcentos($filter['value']).'%';
        }
        if($filter['type'] == 'date'){
            $date = \DateTime::createFromFormat('d/m/Y', $paramValue);
            $paramValue = $date->format('Y-m-d');
        }
        if($filter['type'] == 'dateTime'){
            $date = \DateTime::createFromFormat('d/m/Y H:i', $paramValue);
            $paramValue = $date->format(\DateTime::W3C);
        }
        $condition = $filter['tableName'].".".$filter['content']." ".$filter['operador']." ".$paramName;
        if($condition){
            $this->getQuery()->andWhere($condition);
            $this->getQuery()->setParameter($paramName, $paramValue, $paramType);
        }
    }


    /**
     * @return QueryBuilder
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param QueryBuilder $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

}