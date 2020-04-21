<?php


namespace Pummax\Controller;


use Pummax\Repository\BaseRepository;
use Pummax\Response\GridResponse;
use Pummax\View\Grid\AbstractGrid;

abstract class BaseGridController extends BaseController
{

    const PAGE_LIMIT = 10;

    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * @var AbstractGrid
     */
    protected $view;

    /**
     * Função padrão que o grid chama
     */
    public function index(){
        $page = $this->getParam('page');
        if(!$page){
            $page = 1;
        }
        if($page == 1){
            $minLimit = 0;
        }else{
            $minLimit = (self::PAGE_LIMIT * $page) - self::PAGE_LIMIT;
        }
        $filters = $this->getParam('filters', []);
        $query = $this->createInstanceQuery();
        $filterGrid = new FilterGridController($query, $filters);
        $query = $filterGrid->adicionaCondicoes();
        $queryCount = $this->createInstanceQuery();
        $filterGrid = new FilterGridController($queryCount, $filters);
        $queryCount = $filterGrid->adicionaCondicoes();
        $queryCount->resetDQLPart('select');
        $count = $queryCount->addSelect('count(1)')->getQuery()->getSingleScalarResult();
        $dataQuery = $query->setFirstResult($minLimit)->setMaxResults(self::PAGE_LIMIT);
        $results = $dataQuery->getQuery()->getScalarResult();
        //Formata as datas
        foreach ($results as $key => $result){
            foreach ($result as $keyField =>$field){
                if ($field instanceof \DateTime){
                    $results[$key][$keyField] = $field->format('d/m/Y H:i');
                }
            }
        }
        return new GridResponse($this->getView(), $results, $count);
    }


    public function __construct()
    {
        parent::__construct();
        $this->setView($this->instanceView());
        $this->setRepository($this->instanceRepository());
    }

    abstract function instanceRepository();

    abstract function instanceView();

    public function createInstanceQuery(){
        return $this->getRepository()->createQueryConsulta();
    }

    /**
     * @return BaseRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AbstractGrid
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

}