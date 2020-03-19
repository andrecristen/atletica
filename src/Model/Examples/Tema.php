<?php
/**
 * Created by PhpStorm.
 * User: LaDev
 * Date: 26/06/2019
 * Time: 15:59
 */

namespace Model;
/**
 * @Entity
 * @Table(name="temas")
 */
class Tema{
    /**
    * @Id
    * @Column(name="tem_id", type="integer")
    * @GeneratedValue(strategy="IDENTITY")
    */
    protected $id;
    /**
     * @Column(name="tem_nome", type="string")
     */
    protected $nome;
    /**
     * @Column(name="tem_descricao", type="string")
     */
    protected $descricao;

    function getId()
    {
        return $this->id;
    }

     function getNome()
    {
        return $this->nome;
    }

     function setNome($nome)
    {
        $this->nome = $nome;
    }

     function getDescricao()
    {
        return $this->descricao;
    }

     function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
}


