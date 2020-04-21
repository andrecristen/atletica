<?php


namespace Control\Grid;


use Model\Parceiro;
use Pummax\Controller\BaseGridController;
use View\Grid\ParceiroGrid;

class ParceiroGridController extends BaseGridController
{

    public function instanceRepository()
    {
        return $this->getEntityManager()->getRepository(Parceiro::class);
    }

    public function instanceView()
    {
        return new ParceiroGrid();
    }
}