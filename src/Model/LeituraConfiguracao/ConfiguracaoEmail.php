<?php


namespace Model\LeituraConfiguracao;


/**
 * Classe de leitura das configurações de email.
 * @package Model
 */
class ConfiguracaoEmail extends BaseConfiguracao
{
    public function getHost(){
        return $this->getDataValue('host');
    }

    public function getPort(){
        return $this->getDataValue('port');
    }

    public function getSmtpSecure(){
        return $this->getDataValue('smtpSecure');
    }

    public function getUsername(){
        return $this->getDataValue('username');
    }

    public function getSenha(){
        return $this->getDataValue('senha');
    }

    public function getFromName(){
        return $this->getDataValue('fromName');
    }

}