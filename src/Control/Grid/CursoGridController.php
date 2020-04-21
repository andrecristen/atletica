<?php


namespace Control\Grid;


use Model\Curso;
use Pummax\Controller\BaseGridController;
use View\Grid\CursoGrid;

class CursoGridController extends BaseGridController
{
    public function instanceRepository()
    {
        return $this->getEntityManager()->getRepository(Curso::class);
    }

    public function instanceView()
    {
        return new CursoGrid();
    }
}