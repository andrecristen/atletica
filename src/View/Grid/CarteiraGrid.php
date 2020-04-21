<?php


namespace View\Grid;


use Model\Carteira;
use Model\Curso;
use Model\Pessoa;
use Model\Usuario;
use Pummax\View\Grid\AbstractGrid;
use Pummax\View\Grid\Action;
use Pummax\View\Grid\Column;

class CarteiraGrid extends AbstractGrid
{

    public function getModelNameBase()
    {
        return Carteira::class;
    }

    public function createColumns()
    {
        $this->addColumn(new Column('#', 'id', Column::TYPE_NUMBER, $this->getModelNameBase(),true, '5%'));
        $this->addColumn(new Column('Data Vencimento', 'dataVencimento', Column::TYPE_DATE, $this->getModelNameBase(),true, '10%'));
        $this->addColumn(new Column('#Curso', 'id', Column::TYPE_NUMBER, Curso::class,true, '5%'));
        $this->addColumn(new Column('Curso', 'nome', Column::TYPE_TEXT, Curso::class,true, '10%'));
        $this->addColumn(new Column('Login', 'login', Column::TYPE_TEXT, Usuario::class,true, '10%'));
        $this->addColumn(new Column('Nome', 'nome', Column::TYPE_TEXT, Pessoa::class,true, '20%'));
        $this->addColumn(new Column('Sobrenome', 'sobrenome', Column::TYPE_TEXT, Pessoa::class,true, '40%'));
        $this->addColumn(new Column('CPF', 'cpf', Column::TYPE_TEXT, Pessoa::class,true, '10%'));
    }

    public function createActions()
    {
        $this->addAction(new Action('Nova Carteira', 'addCarteira', 'far fa-plus-square','btn-primary'));
        $this->addAction(new Action('Editar', 'editCarteira', 'far fa-edit','btn-success',true));
        $this->addAction(new Action('Visualizar', 'viewCarteira','fas fa-search' , 'btn-info',true));
    }

}