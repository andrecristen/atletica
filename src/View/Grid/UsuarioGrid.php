<?php


namespace View\Grid;


use Model\Pessoa;
use Model\Usuario;
use Pummax\View\Grid\AbstractGrid;
use Pummax\View\Grid\Action;
use Pummax\View\Grid\Column;

class UsuarioGrid extends AbstractGrid
{

    public function getModelNameBase()
    {
        return Usuario::class;
    }

    public function createColumns()
    {
        $this->addColumn(new Column('#', 'id', Column::TYPE_NUMBER, $this->getModelNameBase(),true, '5%'));
        $this->addColumn(new Column('Login', 'login', Column::TYPE_TEXT,$this->getModelNameBase(),true));
        $this->addColumn(new Column('Nome', 'nome', Column::TYPE_TEXT, Pessoa::class,true, '20%'));
        $this->addColumn(new Column('Sobrenome', 'sobrenome', Column::TYPE_TEXT, Pessoa::class,true, '40%'));
        $this->addColumn(new Column('CPF', 'cpf', Column::TYPE_TEXT, Pessoa::class,true, '10%'));
    }

    public function createActions()
    {
        $this->addAction(new Action('Adicionar', 'addUsuario', 'far fa-plus-square'));
        $this->addAction(new Action('Editar', 'editUsuario', 'far fa-edit','btn-success',true));
        $this->addAction(new Action('Visualizar', 'viewUsuario','fas fa-search' , 'btn-info',true));
    }
}