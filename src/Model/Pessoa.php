<?php


namespace Model;

/**
 * @Entity(repositoryClass="Repository\PessoaRepository")
 * @Table(name="pessoas")
 */
class Pessoa
{
    /**
     * @Id
     * @Column(name="pes_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="pes_nome", type="string")
     */
    protected $nome;

    /**
     * @Column(name="pes_sobrenome", type="string")
     */
    protected $sobrenome;

    /**
     * @Column(name="pes_cpf", type="string")
     */
    protected $cpf;

    /**
     * @Column(name="pes_data_nascimento", type="date")
     */
    protected $dataNascimento;

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
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @param mixed $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }



}