<?php


namespace View\Grid;


use Model\Parceiro;
use Pummax\View\Grid\AbstractGrid;
use Pummax\View\Grid\Action;
use Pummax\View\Grid\Column;

class ParceiroGrid extends AbstractGrid
{
    public function getModelNameBase()
    {
        return Parceiro::class;
    }

    public function createColumns()
    {
        $this->addColumn(new Column('#', 'id', Column::TYPE_NUMBER, $this->getModelNameBase(),true, '5%'));
        $this->addColumn(new Column('CNPJ', 'cnpj', Column::TYPE_TEXT, $this->getModelNameBase(),true));
        $this->addColumn(new Column('Nome', 'nome', Column::TYPE_TEXT, $this->getModelNameBase(),true));
        $this->addColumn(new Column('Desconto %', 'porcentagemDesconto', Column::TYPE_NUMBER, $this->getModelNameBase(),true));
        $this->addColumn(new Column('Ativo', 'ativo', Column::TYPE_BOOLEAN, $this->getModelNameBase(),true));
    }

    public function createActions()
    {
        $this->addAction(new Action('Adicionar', 'addParceiro', 'far fa-plus-square'));
        $this->addAction(new Action('Editar', 'editParceiro', 'far fa-edit','btn-success',true));
        $this->addAction(new Action('Inativar', 'inativarParceiro', 'fas fa-toggle-off','btn-danger',true));
        $this->addAction(new Action('Ativar', 'ativarParceiro', 'fas fa-toggle-on','btn-success',true));
        $this->addAction(new Action('Visualizar', 'viewParceiro','fas fa-search' , 'btn-info',true));
    }
}