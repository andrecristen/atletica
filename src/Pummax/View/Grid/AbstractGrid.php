<?php


namespace Pummax\View\Grid;


use Pummax\Controller\BaseController;
use Pummax\Interfaces\IArrayFormat;

abstract class AbstractGrid extends BaseController implements IArrayFormat
{

    public function __construct()
    {
        parent::__construct();
        $this->createColumns();
        $this->createActions();
    }

    /**
     * Retona o nome do modelo a ser usado no grid
     *
     * @return string
     */
    abstract function getModelNameBase();

    /**
     * @var Column[]
     */
    protected $columns;

    /**
     * @var Action[]
     */
    protected $actions;

    abstract function createColumns();
    abstract function createActions();

    public function getArrayFormat(){
        $array = [];
        foreach ($this->getColumns() as $column){
            $array['columns'][] = $column->getArrayFormat();
        }
        foreach ($this->getActions() as $action){
            $array['actions'][] = $action->getArrayFormat();
        }
        return $array;
    }

    /**
     * @return Column[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param Column $column
     * @return Column
     */
    public function addColumn(Column $column)
    {
        $this->columns[] = $column;
        return $column;
    }

    /**
     * @return Action[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param Action $action
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;
    }


}