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
        $this->addScopeData('TIPO_IMAGEM', Configuracao::TIPO_IMAGEM);
        $this->addScopeData('TIPO_PRECO', Configuracao::TIPO_PRECO);
        $this->addScopeData('TIPO_TEXTOS_SITE', Configuracao::TIPO_TEXTOS_SITE);
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
                        <!-- Imagem -->
                        <div ng-if="data.tipo == TIPO_IMAGEM">
                            <fieldset>
                                <legend>Banner</legend>
                                <div class="form-group">
                                    <label for="alturabanner">Altura</label>
                                    <input ng-required="true" ng-model="data.configuracao[\'alturaBanner\']" type="number" class="form-control" id="alturabanner" >
                                </div>
                                <div class="form-group">
                                    <label for="largurabanner">Largura</label>
                                    <input ng-required="true" ng-model="data.configuracao[\'larguraBanner\']" type="number" class="form-control" id="largurabanner" >        
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Carteira</legend>
                                <div class="form-group">
                                    <label for="alturacarteira">Altura</label>
                                    <input ng-required="true" ng-model="data.configuracao[\'alturaCarteira\']" type="number" class="form-control" id="alturacarteira" >
                                </div>
                                <div class="form-group">
                                    <label for="larguracarteira">Largura</label>
                                    <input ng-required="true" ng-model="data.configuracao[\'larguraCarteira\']" type="number" class="form-control" id="larguracarteira" >        
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Parceiro</legend>
                                <div class="form-group">
                                    <label for="alturaparceiro">Altura</label>
                                    <input ng-required="true" ng-model="data.configuracao[\'alturaParceiro\']" type="number" class="form-control" id="alturaparceiro" >
                                </div>
                                <div class="form-group">
                                    <label for="larguraparceiro">Largura</label>
                                    <input ng-required="true" ng-model="data.configuracao[\'larguraParceiro\']" type="number" class="form-control" id="larguraparceiro" >        
                                </div>
                            </fieldset>
                        </div>
                        <!-- Preço -->
                        <div ng-if="data.tipo == TIPO_PRECO">
                            <div class="form-group">
                                <label for="port">1 Semestre</label>
                                <input ng-required="true" ng-model="data.configuracao[\'um_semestre\']" type="text" class="form-control" id="port" >
                            </div>
                            <div class="form-group">
                                <label for="port">2 Semestres (Valor por semestre)</label>
                                <input ng-required="true" ng-model="data.configuracao[\'dois_semestre\']" type="text" class="form-control" id="port" >
                            </div>
                            <div class="form-group">
                                <label for="port">4 Semestres (Valor por semestre)</label>
                                <input ng-required="true" ng-model="data.configuracao[\'quatro_semestre\']" type="text" class="form-control" id="port" >
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