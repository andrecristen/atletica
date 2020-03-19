<?php


namespace Control\Grid;


use Model\Imagem;
use Pummax\Controller\BaseGridController;
use View\Grid\BannerGrid;

class BannerGridController extends BaseGridController
{
    public function instanceRepository()
    {
        return $this->getEntityManager()->getRepository(Imagem::class);
    }

    public function instanceView()
    {
        return new BannerGrid();
    }
}