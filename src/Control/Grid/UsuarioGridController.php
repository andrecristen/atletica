<?php


namespace Control\Grid;


use Model\Usuario;
use Pummax\Controller\BaseGridController;
use View\Grid\UsuarioGrid;

class UsuarioGridController extends BaseGridController
{

    public function instanceRepository()
    {
        return $this->getEntityManager()->getRepository(Usuario::class);
    }

    public function instanceView()
    {
       return new UsuarioGrid();
    }

}