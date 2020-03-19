<?php

namespace Model;
/**
 * @Entity
 * @Table(name="integrantes")
 */
class Integrante
{
    /**
     * @Id
     * @Column(name="int_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @Column(name="int_nome", type="string")
     */
    protected $nome;
    /**
     * @Column(name="int_cargo", type="string")
     */
    protected $cargo;

    /**
     * @ManyToOne(targetEntity="Gremio", inversedBy="integrantes")
     * @JoinColumn(name="gre_id", referencedColumnName="gre_id")
     */
    protected $gremio;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return mixed
     */
    public function getGremio()
    {
        return $this->gremio;
    }

    /**
     * @param mixed $gremio
     */
    public function setGremio($gremio)
    {
        $this->gremio = $gremio;
    }

}