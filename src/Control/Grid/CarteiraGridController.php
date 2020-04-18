<?php


namespace Control\Grid;


use Model\Carteira;
use Pummax\Controller\BaseGridController;
use View\Grid\CarteiraGrid;

class CarteiraGridController extends BaseGridController
{
    public function instanceRepository()
    {
        return $this->getEntityManager()->getRepository(Carteira::class);
    }

    public function instanceView()
    {
        return new CarteiraGrid();
    }

}