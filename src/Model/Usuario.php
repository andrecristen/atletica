<?php


namespace Model;

/**
 * @Entity(repositoryClass="Repository\UsuarioRepository")
 * @Table(name="usuarios")
 */
class Usuario
{
    /**
     * @Id
     * @Column(name="usu_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="usu_login", type="string", unique=true)
     */
    protected $login;

    /**
     * @Column(name="usu_senha", type="string")
     */
    protected $senha;

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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }



}