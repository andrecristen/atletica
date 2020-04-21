<?php


namespace Model;

/**
 * @Entity(repositoryClass="Repository\CarteiraRepository")
 * @Table(name="carteiras")
 */
class Carteira
{

    /**
     * @Id
     * @Column(name="car_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Curso")
     * @JoinColumn(name="cur_id", referencedColumnName="cur_id", nullable=false)
     */
    protected $curso;

    /**
     * @ManyToOne(targetEntity="Usuario")
     * @JoinColumn(name="usu_id", referencedColumnName="usu_id", nullable=false)
     */
    protected $usuario;

    /**
     * @Column(name="car_data_vencimento", type="date")
     */
    protected $dataVencimento;

    /**
     * @ManyToOne(targetEntity="Imagem")
     * @JoinColumn(name="img_id", referencedColumnName="img_id", nullable=false)
     */
    protected $imagem;

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
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param mixed $curso
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    /**
     * @param mixed $dataVencimento
     */
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;
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
}