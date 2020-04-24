<?php


namespace View\Site;


use Pummax\View\BaseView;

class FrontEndCarteirinha extends BaseView
{

    public function createHtml()
    {
        ?>
        <div class="id-card-holder">
            <div class="id-card">
                <div class="row headers">
                    <div class="header-left">
                        <img src="/utils/img/logo2.jpg">
                    </div>
                    <div class="header-right">
                        <img src="data:image/png;base64,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">
                    </div>
                </div>
                <div class="photo">
                    <img src="https://image.shutterstock.com/image-vector/user-icon-trendy-flat-style-260nw-418179865.jpg">
                </div>
                <h2>Sócio Tribo do Vale</h2>
                <h5>Associação atlética acadêmica ceavi</h5>
                <h6>Nome estudante</h6>
                <h6>Data nascimento</h6>
                <h6>CPF</h6>
                <h6>Matricula</h6>
                <h6>Curso</h6>
                <div class="qr-code">
                    <img src="https://www.shopify.com/growth-tools-assets/qr-code/shopify-faae7065b7b351d28495b345ed76096c03de28bac346deb1e85db632862fd0e4.png">
                </div>
            </div>
        </div>
        <?php
    }
}
?>