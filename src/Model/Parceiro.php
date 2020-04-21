<?php


namespace Model;

/**
 * @Entity(repositoryClass="Repository\ParceiroRepository")
 * @Table(name="parceiros")
 */
class Parceiro
{

    /**
     * @Id
     * @Column(name="par_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Imagem")
     * @JoinColumn(name="img_id", referencedColumnName="img_id", nullable=false)
     */
    protected $imagem;

    /**
     * @Column(name="par_cnpj", type="string")
     */
    protected $cnpj;

    /**
     * @Column(name="par_nome", type="string")
     */
    protected $nome;

    /**
     * @Column(name="par_porcentagem_desconto", type="decimal")
     */
    protected $porcentagemDesconto;

    /**
     * @ManyToOne(targetEntity="Endereco")
     * @JoinColumn(name="end_id", referencedColumnName="end_id", nullable=true)
     */
    protected $endereco;

    /**
     * @Column(name="par_ativo", type="boolean")
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
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
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
    public function getPorcentagemDesconto()
    {
        return $this->porcentagemDesconto;
    }

    /**
     * @param mixed $porcentagemDesconto
     */
    public function setPorcentagemDesconto($porcentagemDesconto)
    {
        $this->porcentagemDesconto = $porcentagemDesconto;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
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