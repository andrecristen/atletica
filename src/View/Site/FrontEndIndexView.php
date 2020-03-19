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
        ?>
       <?php Facilitador::createMenuSite() ?>
        <main style="margin-top: 75px" role="main" class="container">
            <div style="margin: 20px;" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </main>
       <?php Facilitador::createFooterSite() ?>
        <?php
    }

}