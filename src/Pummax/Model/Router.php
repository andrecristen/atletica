<?php

/**
 * @Entity
 * @Table(name="pu_router")
 */
class Router
{
    /**
     * @Id
     * @Column(name="router_name", type="string")
     */
    protected $nome;

    /**
     * @Column(name="router_descricao", type="string")
     */
    protected $descricao;

    /**
     * @Column(name="router_controller", type="string")
     */
    protected $controller;

    /**
     * @Column(name="router_public", type="boolean", options={"default"=false})
     */
    protected $public;

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

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param mixed $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }


}