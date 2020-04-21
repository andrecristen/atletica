<?php

namespace Model;
/**
 * @Entity(repositoryClass="Repository\ImagemRepository")
 * @Table(name="imagens")
 */
class Imagem{

     const TIPO_BANNER = 1;
     const TIPO_USUARIO = 2;
     const TIPO_PARCEIRO = 3;

    /**
     * @Id
     * @Column(name="img_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="img_titulo", type="string")
     */
    protected $titulo;

    /**
     * @Column(name="img_patch", type="text")
     */
    protected $patch;

    /**
     * @Column(name="img_nome", type="string")
     */
    protected $nome;

    /**
     * @Column(name="img_tipo", type="smallint")
     */
    protected $tipo;


    /**
     * @Column(name="img_ativo", type="boolean")
     */
    protected $ativo;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    function getTitulo()
    {
        return $this->titulo;
    }


     function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

     function getPatch()
    {
        return $this->patch;
    }

     function setPatch($patch)
    {
        $this->patch = $patch;
    }

     function getNome()
    {
        return $this->nome;
    }


     function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    public static function tipoList(){
        return [
          self::TIPO_BANNER => 'Banner',
          self::TIPO_USUARIO => 'Usuario',
          self::TIPO_PARCEIRO=> 'Parceiro',
        ];
    }
}


