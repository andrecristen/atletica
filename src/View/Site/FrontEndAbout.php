<?php

namespace View\Site;

use Model\Configuracao;
use Pummax\View\BaseView;
use Pummax\View\Facilitador;

class FrontEndAbout extends BaseView
{

    public function createHtml()
    {
        /** @var $precoConfig Configuracao*/
        $precoConfig = $this->getEntityManager()->getRepository(Configuracao::class)->findOneBy(['tipo' => Configuracao::TIPO_PRECO]);
        $config = $precoConfig->getConfiguracaoModel();
        ?>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Como funciona?</h1>
            <p class="lead">Você escolhe o plano! Contata qualquer membro da atlética! Paga! E já pode desfrutar de todos os nosso parceiros...</p>
        </div>
        <div class="container" style="margin-bottom: 90px">
            <div class="card-deck mb-3 text-center">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">1 Semestre</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">R$<?= $config->getUmSemestre() ?> <small class="text-muted"></small></h1>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">2 Semestres</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">R$<?= $config->getDoisSemestres() ?>  <small class="text-muted">/ por semestre</small></h1>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">4 Semestres</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">R$<?= $config->getQuatroSemestres() ?>  <small class="text-muted">/ por semestre</small></h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}