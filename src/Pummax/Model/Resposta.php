<?php
/**
 * Criado: Fernando Cristen
 * Data: 02/09/2019
 * Hora: 23:43
 */

namespace Pummax\Model;


class Resposta
{
    private $fields;

    private $dados;

    private $acoesLinha;

    private $acoes;

    public function __construct($fields, $dados, $acoesLinha, $acoes)
    {
        $this->fields = $fields;
        $this->dados = $dados;
        $this->acoesLinha = $acoesLinha;
        $this->acoes = $acoes;
    }

    public function getFormatoJSON(){
        echo json_encode([
            'fields' => $this->getFields(),
            'dados' => $this->getDados(),
            'acoesLinha' => $this->getAcoesLinha(),
            'acoes' => $this->getAcoes()
        ]);
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }


    /**
     * @return mixed
     */
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * @param mixed $dados
     */
    public function setDados($dados)
    {
        $this->dados = $dados;
    }

    /**
     * @return mixed
     */
    public function getAcoes()
    {
        return $this->acoes;
    }

    /**
     * @param mixed $acoes
     */
    public function setAcoes($acoes)
    {
        $this->acoes = $acoes;
    }

    /**
     * @return mixed
     */
    public function getAcoesLinha()
    {
        return $this->acoesLinha;
    }

    /**
     * @param mixed $acoesLinha
     */
    public function setAcoesLinha($acoesLinha)
    {
        $this->acoesLinha = $acoesLinha;
    }
}