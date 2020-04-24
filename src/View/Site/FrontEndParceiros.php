<?php


namespace View\Site;


use Pummax\View\BaseView;

class FrontEndParceiros extends BaseView
{

    public function createHtml()
    {
        ?>
        <div class="card-group vgr-cards">
            <div class="card">
                <div class="card-img-body">
                    <img class="card-img" src="https://picsum.photos/500/230" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Parceiro</h4>
                    <p class="card-text">Texto sobre o parceiro Texto sobre o parceiroTexto sobre o parceiro
                        Texto sobre o parceiroTexto sobre o parceiroTexto sobre o parceiroTexto sobre o parceiro
                        Texto sobre o parceiroTexto sobre o parceiroTexto sobre o parceiro
                        Texto sobre o parceiroTexto sobre o parceiroTexto sobre o parceiro
                        Texto sobre o parceiroTexto sobre o parceiroTexto sobre o parceiro
                    </p>
                </div>
            </div>
        </div>

        <?php
    }
}

?>