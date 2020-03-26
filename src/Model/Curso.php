<?php


namespace Model;


/**
 * @Entity(repositoryClass="Repository\CursoRepository")
 * @Table(name="cursos")
 */
class Curso
{

    /**
     * @Id
     * @Column(name="cur_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="cur_nome", type="string", unique=true)
     */
    protected $nome;


    /**
     * @Column(name="cur_ativo", type="boolean")
     */
    protected $ativo;

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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }





}