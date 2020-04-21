<?php


namespace Model;

/**
 * @Entity(repositoryClass="Repository\UsuarioRepository")
 * @Table(name="usuarios")
 */
class Usuario
{

    const TIPO_ADMIN = 1;
    const TIPO_ALUNO = 2;

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
     * @ManyToOne(targetEntity="Pessoa")
     * @JoinColumn(name="pes_id", referencedColumnName="pes_id", nullable=false)
     */
    protected $pessoa;

    /**
     * @Column(name="usu_token", type="string")
     */
    protected $token;

    /**
     * @Column(name="usu_tipo", type="smallint", nullable=false, options={"default":2})
     */
    protected $tipo;

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

    /**
     * @return mixed
     */
    public function getPessoa()
    {
        return $this->pessoa;
    }

    /**
     * @param mixed $pessoa
     */
    public function setPessoa($pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
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


    public static function getTipoList(){
        return [
            self::TIPO_ADMIN => 'Administrador',
            self::TIPO_ALUNO => 'Aluno',
        ];
    }

    public static function generateToken(Usuario $usuario){
        return md5(uniqid($usuario->getLogin(), true));
    }


}