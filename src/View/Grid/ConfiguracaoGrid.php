<?php


namespace View\Grid;


use Model\Configuracao;
use Pummax\View\Grid\AbstractGrid;
use Pummax\View\Grid\Action;
use Pummax\View\Grid\Column;

class ConfiguracaoGrid extends AbstractGrid
{
    public function getModelNameBase()
    {
        return Configuracao::class;
    }

    public function createColumns()
    {
        $this->addColumn(new Column('#', 'id', Column::TYPE_NUMBER, $this->getModelNameBase(),true));
        $tipo = $this->addColumn(new Column('Tipo', 'tipo', Column::TYPE_LIST, $this->getModelNameBase(),true));
        $tipo->setList(Configuracao::getTipoList());
    }

    public function createActions()
    {
        $this->addAction(new Action('Adicionar', 'addConfiguracao', 'far fa-plus-square'));
        $this->addAction(new Action('Editar', 'editConfiguracao', 'far fa-edit','btn-success',true));
    }
}