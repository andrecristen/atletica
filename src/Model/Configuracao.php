<?php


namespace Model;


use Model\LeituraConfiguracao\ConfiguracaoEmail;
use Model\LeituraConfiguracao\ConfiguracaoImagem;

/**
 * @Entity(repositoryClass="Repository\ConfiguracaoRepository")
 * @Table(name="configuracoes")
 */
class Configuracao
{

    const TIPO_EMAIL = 1;
    const TIPO_IMAGEM = 2;
    const TIPO_PRECO = 3;
    const TIPO_TEXTOS_SITE = 4;

    /**
     * @Id
     * @Column(name="conf_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="conf_tipo", type="smallint", unique=true)
     */
    protected $tipo;


    /**
     * @Column(name="conf_configuracao", type="json_array")
     */
    protected $configuracao;

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
    public function getConfiguracao()
    {
        return $this->configuracao;
    }

    /**
     * @param mixed $configuracao
     */
    public function setConfiguracao($configuracao)
    {
        $this->configuracao = $configuracao;
    }

    public static function getTipoList(){
        return [
            self::TIPO_EMAIL => 'E-mail',
            self::TIPO_IMAGEM => 'Imagens',
            self::TIPO_PRECO => 'Preço',
            self::TIPO_TEXTOS_SITE => 'Textos Site',
        ];
    }

    public function getConfiguracaoModel(){
        switch ($this->getTipo()){
            case self::TIPO_EMAIL:
                return new ConfiguracaoEmail($this);
                break;
             case self::TIPO_IMAGEM:
                return new ConfiguracaoImagem($this);
                break;
            default:
                return null;
                break;
        }
    }

}