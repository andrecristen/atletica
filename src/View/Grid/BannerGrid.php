<?php


namespace View\Grid;


use Model\Imagem;
use Pummax\View\Grid\AbstractGrid;
use Pummax\View\Grid\Action;
use Pummax\View\Grid\Column;

class BannerGrid extends AbstractGrid
{
    public function getModelNameBase()
    {
        return Imagem::class;
    }

    public function createColumns()
    {
        $this->addColumn(new Column('#', 'id', Column::TYPE_NUMBER, $this->getModelNameBase(), true));
        $this->addColumn(new Column('Título', 'titulo', Column::TYPE_TEXT, $this->getModelNameBase(), true));
        $this->addColumn(new Column('Nome', 'nome', Column::TYPE_TEXT, $this->getModelNameBase(), true));
        $this->addColumn(new Column('Ativo', 'ativo', Column::TYPE_BOOLEAN, $this->getModelNameBase(), true));
    }

    public function createActions()
    {
        $this->addAction(new Action('Adicionar', 'addBanner', 'far fa-plus-square'));
        $this->addAction(new Action('Inativar', 'inativarBanner', 'fas fa-toggle-off','btn-danger',true));
        $this->addAction(new Action('Ativar', 'ativarBanner', 'fas fa-toggle-on','btn-success',true));
        $this->addAction(new Action('Visualizar', 'viewBanner','fas fa-search' , 'btn-info',true));
    }
}