<?php

namespace Model;
/**
 * @Entity
 * @Table(name="gremio", indexes={@Index(name="ativo_index", columns={"gre_mandato_atual"}, options={"where": "(gre_mandato_atual = true)"})})
 */
class Gremio
{

    /**
     * @Id
     * @Column(name="gre_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="gre_nome_chapa", type="string", nullable=false)
     */
    protected $nomeChapa;

    /**
     * @OneToMany(targetEntity="Integrante", mappedBy="gremio")
     */
    public $integrantes;

    /**
     * @Column(name="gre_mandato_atual", type="boolean")
     */
    protected $mandatoAtual;

    /**
     * @Column(name="gre_corpo", type="text", nullable=true)
     */
    protected $descricao;

    public function __construct()
    {
        $this->integrantes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomeChapa()
    {
        return $this->nomeChapa;
    }

    /**
     * @param mixed $nomeChapa
     */
    public function setNomeChapa($nomeChapa)
    {
        $this->nomeChapa = $nomeChapa;
    }

    /**
     * @return mixed
     */
    public function getIntegrantes()
    {
        return $this->integrantes;
    }

    /**
     * @param mixed $integrantes
     */
    public function setIntegrantes($integrantes)
    {
        $this->integrantes = $integrantes;
    }

    /**
     * @return mixed
     */
    public function getMandatoAtual()
    {
        return $this->mandatoAtual;
    }

    /**
     * @param mixed $mandatoAtual
     */
    public function setMandatoAtual($mandatoAtual)
    {
        $this->mandatoAtual = $mandatoAtual;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


}


