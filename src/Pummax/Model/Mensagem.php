<?php


namespace Pummax\Model;


use Pummax\Controller\BaseController;

class Mensagem
{
    const TIPO_SUCESSO = 'messageSuccess';
    const TIPO_ERRO = 'messageErro';

    public function __construct($tipo, $mensagem = null)
    {
        if(!$mensagem){
            if($tipo == self::TIPO_SUCESSO){
                $mensagem = "Sucesso ao realizar operação.";
            }elseif ($tipo == self::TIPO_ERRO){
                $mensagem = "Erro ao realizar operação.";
            }
        }
        BaseController::setMessage($tipo, $mensagem);
    }


    public static function getMessageSuccess(){
        $mensagemSuccess = '';
        if(BaseController::getMessageSuccess()){
            $mensagemSuccess =
                '<div class="alert alert-success alert-dismissible fade show alert-pummax content-pummax-message" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Sucesso!</strong>
                    </br>
                    '.BaseController::getMessageSuccess().'
                </div>';
            BaseController::unsetOnSession(Mensagem::TIPO_SUCESSO);
        }
        return $mensagemSuccess;
    }
    public static function getMessageErro(){
        $mensagemErro = '';
        if(BaseController::getMessageErro()){
            $mensagemErro =
                '<div class="alert alert-danger alert-dismissible fade show alert-pummax content-pummax-message" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Atenção!</strong>
                    </br>
                    '.BaseController::getMessageErro().'
                </div>';
            BaseController::unsetOnSession(Mensagem::TIPO_ERRO);
        }
        return $mensagemErro;
    }
}