<?php


namespace Model\LeituraConfiguracao;


class ConfiguracaoPreco extends BaseConfiguracao
{

    public function getUmSemestre()
    {
        return $this->getDataValue('um_semestre');
    }

    public function getDoisSemestres()
    {
        return $this->getDataValue('dois_semestre');
    }

    public function getQuatroSemestres()
    {
        return $this->getDataValue('quatro_semestre');
    }
}