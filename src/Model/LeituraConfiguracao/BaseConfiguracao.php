<?php


namespace Model\LeituraConfiguracao;


use Model\Configuracao;

class BaseConfiguracao
{

    public function __construct(Configuracao $configuracao)
    {
        $this->setConfiguracao($configuracao);
    }

    /**
     * @var Configuracao
     */
    protected $configuracao;

    public function getDataValue($index){
        $data = $this->getConfiguracao()->getConfiguracao();
        if(isset($data[$index])){
            return $data[$index];
        }
        return null;
    }

    /**
     * @return Configuracao
     */
    public function getConfiguracao()
    {
        return $this->configuracao;
    }

    /**
     * @param Configuracao $configuracao
     */
    public function setConfiguracao($configuracao)
    {
        $this->configuracao = $configuracao;
    }

}