<?php


namespace View\Form;


use Pummax\View\Form\AbstractForm;

class ParceiroForm extends AbstractForm
{

    public function defineAtributes()
    {
        $this->setMaximized(true);
    }

    public function createHtml()
    {
        return '
        <div class="form-horizontal">
            <fieldset>
                <legend>Geral</legend>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input ng-required="true" ng-model="data.nome" type="text" class="form-control" id="nome" >
                </div>
                <div class="form-group">
                    <label for="porcentagemDesconto">Descontos</label>
                    <input ng-required="true" ng-model="data.porcentagemDesconto" type="text" class="form-control" id="porcentagemDesconto" >
                </div>
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input ng-required="true" ng-model="data.cnpj" type="text" class="form-control" id="cnpj" >
                </div>
                <div class="form-group">
                    <label for="ativo">Ativo</label>
                    <input ng-model="data.ativo" type="checkbox" class="form-control" id="ativo" >
                </div>
                <div ng-if="data.imagem.id" class="form-group">
                    <label for="arquivo">Imagem Atual</label>
                    <img src="utils{{data.imagem.patch}}">
                </div>
                <div class="form-group">
                    <label ng-if="data.imagem.id" for="arquivo">Alterar Imagem</label>
                    <label ng-if="!data.imagem.id" for="arquivo">Imagem</label>
                    <input ng-required="!data.imagem.id" ng-model="data.arquivo" type="file" class="form-control" id="arquivo" >
                </div>
            </fieldset>
            <fieldset>
                <legend>Endereço</legend>
                <div class="form-group">
                    <label for="endereco.logradouro">Logradouro</label>
                    <input ng-required="true" ng-model="data.endereco.logradouro" type="text" class="form-control" id="logradouro" >
                </div>
                <div class="form-group">
                    <label for="endereco.bairro">Bairro</label>
                    <input ng-required="true" ng-model="data.endereco.bairro" type="text" class="form-control" id="bairro" >
                </div>
                <div class="form-group">
                    <label for="endereco.cidade">Cidade</label>
                    <input ng-required="true" ng-model="data.endereco.cidade" type="text" class="form-control" id="cidade" >
                </div>
                <div class="form-group">
                    <label for="endereco.numero">Número</label>
                    <input ng-required="true" ng-model="data.endereco.numero" type="text" class="form-control" id="numero" >
                </div>
                <div class="form-group">
                    <label for="endereco.complemento">Complemento</label>
                    <input ng-required="true" ng-model="data.endereco.complemento" type="text" class="form-control" id="complemento" >
                </div>
            </fieldset>
        </div>';
    }

    public function getDataMapping()
    {
        return [
            'id',
            'nome',
            'cnpj',
            'porcentagemDesconto',
            'ativo',
            'imagem' => [
                'id',
                'patch'
            ],
            'endereco' => [
                'id',
                'logradouro',
                'bairro',
                'cidade',
                'numero',
                'complemento',
            ]
        ];
    }

    public function getFormName()
    {
        return 'form_parceiro';
    }
}