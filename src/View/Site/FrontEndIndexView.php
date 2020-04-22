<?php


namespace View\Site;


use Pummax\View\BaseView;
use Pummax\View\Facilitador;
use Model\Imagem;use Model\Noticia;
use Model\NoticiaImagem;

class FrontEndIndexView extends BaseView
{

    public function createHtml()
    {
        /** @var $banners Imagem[]*/
        $banners = $this->getEntityManager()->getRepository(Imagem::class)->findBy(['tipo' => Imagem::TIPO_BANNER, 'ativo' => true]);
        ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($banners as $key => $banner){
                    $active = '';
                    if($key == 0){
                        $active = ' class="active" ';
                    }
                    echo '<li data-target="#item" data-slide-to="'.$key.'" '.$active.'></li>';
                } ?>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($banners as $key => $banner){
                    $active = '';
                    if($key == 0){
                        $active = ' active';
                    }
                    echo '<div class="carousel-item '.$active.'">
                            <img class="d-block w-100" src="utils/'.$banner->getPatch().'" alt="'.$banner->getTitulo().'">
                            <div class="carousel-caption d-none d-md-block">
                                <p>'.$banner->getTitulo().'</p>
                            </div>
                         </div>';
                } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
    }

}