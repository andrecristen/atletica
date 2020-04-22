<?php


namespace View\Form;


use Model\Configuracao;
use Pummax\View\Form\AbstractForm;

class ConfiguracaoForm extends AbstractForm
{

    public function defineAtributes()
    {
        $this->setMaximized(true);
        $this->addScopeData('tipoList', Configuracao::getTipoList());
        $this->addScopeData('TIPO_EMAIL', Configuracao::TIPO_EMAIL);
        $this->addScopeData('TIPO_BANNER', Configuracao::TIPO_BANNER);
        $this->addScopeData('TIPO_PRECO', Configuracao::TIPO_PRECO);
        $this->addScopeData('TIPO_TEXTOS_SITE', Configuracao::TIPO_TEXTOS_SITE);

        $remetente = new \Pummax\Mail\Email('smtp.gmail.com', 587, 'tls','andrecristenibirama@gmail.com', 'senhasegura', 'Atletica');
    }

    public function createHtml()
    {
        return '<div class="form-horizontal">
                    <div class="form-group">
                        <label for="curso">Tipo</label>
                        <select ng-disabled="isEdit" ng-model="data.tipo" ng-options="value*1 as label for (value, label) in tipoList" class="form-control select-pummax" id="curso"></select>
                    </div>
                    <fieldset ng-if="data.tipo">
                        <!-- Email -->
                        <div ng-if="data.tipo == TIPO_EMAIL">
                            <div class="form-group">
                                <label for="host">Host</label>
                                <input ng-required="true" ng-model="data.configuracao[\'host\']" type="text" class="form-control" id="host" >
                            </div>
                            <div class="form-group">
                                <label for="port">Port</label>
                                <input ng-required="true" ng-model="data.configuracao[\'port\']" type="text" class="form-control" id="port" >
                            </div>
                            <div class="form-group">
                                <label for="smtpSecure">SMTP Secure</label>
                                <input ng-required="true" ng-model="data.configuracao[\'smtpSecure\']" type="text" class="form-control" id="smtpSecure" >
                            </div>
                            <div class="form-group">
                                <label for="username">Usuário</label>
                                <input ng-required="true" ng-model="data.configuracao[\'username\']" type="text" class="form-control" id="username" >
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input ng-required="true" ng-model="data.configuracao[\'senha\']" type="password" class="form-control" id="senha" >
                            </div>
                            <div class="form-group">
                                <label for="fromName">From Name</label>
                                <input ng-required="true" ng-model="data.configuracao[\'fromName\']" type="text" class="form-control" id="fromName" >
                            </div>
                        </div>
                        <!-- Banner -->
                        <div ng-if="data.tipo == TIPO_BANNER">
                            <div class="form-group">
                                <label for="altura">Altura</label>
                                <input ng-required="true" ng-model="data.configuracao[\'altura\']" type="number" class="form-control" id="altura" >
                            </div>
                            <div class="form-group">
                                <label for="largura">Largura</label>
                                <input ng-required="true" ng-model="data.configuracao[\'largura\']" type="number" class="form-control" id="largura" >        
                            </div>
                        </div>
                        <!-- Preço -->
                        <div ng-if="data.tipo == TIPO_PRECO">
                            <div class="alert alert-danger">
                                <span>Não utilizado</span>
                            </div>
                        </div>
                        <!-- Textos Site -->
                        <div ng-if="data.tipo == TIPO_TEXTOS_SITE">
                            <div class="alert alert-danger">
                                <span>Não utilizado</span>
                            </div>
                        </div>
                    </fieldset>
                </div>';
    }

    public function getDataMapping()
    {
        return [
            'id',
            'tipo',
            'configuracao',
        ];
    }

    public function getFormName()
    {
        return 'form_configuracao';
    }
}