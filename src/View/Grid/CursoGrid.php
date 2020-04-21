<?php


namespace View\Grid;


use Model\Curso;
use Pummax\View\Grid\AbstractGrid;
use Pummax\View\Grid\Action;
use Pummax\View\Grid\Column;

class CursoGrid extends AbstractGrid
{
    public function getModelNameBase()
    {
        return Curso::class;
    }

    public function createColumns()
    {
        $this->addColumn(new Column('#', 'id', Column::TYPE_NUMBER, $this->getModelNameBase(),true, '5%'));
        $this->addColumn(new Column('Nome', 'nome', Column::TYPE_TEXT, $this->getModelNameBase(),true));
        $this->addColumn(new Column('Ativo', 'ativo', Column::TYPE_BOOLEAN, $this->getModelNameBase(),true));
    }

    public function createActions()
    {
        $this->addAction(new Action('Adicionar', 'addCurso', 'far fa-plus-square'));
        $this->addAction(new Action('Editar', 'editCurso', 'far fa-edit','btn-success',true));
        $this->addAction(new Action('Visualizar', 'viewCurso','fas fa-search' , 'btn-info',true));
    }
}