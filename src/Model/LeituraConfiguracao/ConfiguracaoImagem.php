<?php


namespace Model\LeituraConfiguracao;


/**
 * Classe de leitura das configurações de imagem.
 * @package Model\LeituraConfiguracao
 */
class ConfiguracaoImagem extends BaseConfiguracao
{
    public function getAlturaBanner()
    {
        return $this->getDataValue('alturaBanner');
    }

    public function getLarguraBanner()
    {
        return $this->getDataValue('larguraBanner');
    }

    public function getAlturaCarteira()
    {
        return $this->getDataValue('alturaCarteira');
    }

    public function getLarguraCarteira()
    {
        return $this->getDataValue('larguraCarteira');
    }

}