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
    }

    public function createActions()
    {
        $this->addAction(new Action('Adicionar', 'addBanner', 'far fa-plus-square'));
        $this->addAction(new Action('Editar', 'editBanner', 'far fa-edit','btn-success',true));
        $this->addAction(new Action('Visualizar', 'viewBanner','fas fa-search' , 'btn-info',true));
        $this->addAction(new Action('Excluir', 'deleteBanner', 'far fa-trash-alt', 'btn-danger', true));
    }
}