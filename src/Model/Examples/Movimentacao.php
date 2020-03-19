<?php
/**
 * Created by PhpStorm.
 * User: LaDev
 * Date: 26/06/2019
 * Time: 16:10
 */

namespace Model;
/**
 * @Entity
 * @Table(name="movimentacoes")
 */
class Movimentacao{

    const TIPO_ENTRADA = 1;
    const TIPO_SAIDA = 2;

    /**
     * @Id
     * @Column(name="mov_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="mov_titulo", type="string")
     */
    protected $titulo;

    /**
     * @Column(name="mov_tipo", type="smallint")
     */
    protected $tipo;
    /**
     * @Column(name="mov_descricao", type="text")
     */
    protected $descricao;

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

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }


    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }


    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public static function getTipoList(){
        return [
            self::TIPO_ENTRADA => 'Entrada',
            self::TIPO_SAIDA => 'Saida',
        ];
    }


}