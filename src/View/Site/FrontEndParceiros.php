<?php


namespace View\Site;


use Model\Parceiro;
use Pummax\View\BaseView;

class FrontEndParceiros extends BaseView
{

    public function __construct($createMenu = true, $createFooter = false)
    {
        parent::__construct($createMenu, $createFooter);
    }

    public function createHtml()
    {
        /** @var $parceiros Parceiro[] */
        $parceiros = $this->getEntityManager()->getRepository(Parceiro::class)->findBy(['ativo' => true]);
        ?>
        <div class="row">
            <?php
            foreach ($parceiros as $parceiro) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card">
                        <div class="text-center">
                            <img class="card-img-top" src="utils/<?= $parceiro->getImagem()->getPatch() ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?= $parceiro->getNome() ?></h4>
                            <hr>
                            <h6 class="card-title">CNPJ:&nbsp;<?= $parceiro->getCnpj() ?></h6>
                            <h6 class="card-title">Desconto(s):&nbsp;<?= $parceiro->getPorcentagemDesconto() ?></h6>
                            <hr>
                            <h5 class="card-title">Endereço</h5>
                            <h6 class="card-title">Logradouro:&nbsp;<?= $parceiro->getEndereco()->getLogradouro() ?></h6>
                            <h6 class="card-title">Bairro:&nbsp;<?= $parceiro->getEndereco()->getBairro() ?></h6>
                            <h6 class="card-title">Cidade:&nbsp;<?= $parceiro->getEndereco()->getCidade() ?></h6>
                            <h6 class="card-title">Número:&nbsp;<?= $parceiro->getEndereco()->getNumero() ?></h6>
                            <h6 class="card-title">Complento:&nbsp;<?= $parceiro->getEndereco()->getComplemento() ?></h6>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}

?>