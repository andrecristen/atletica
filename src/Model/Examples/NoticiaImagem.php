<?php
/**
 * Criado: Fernando Cristen
 * Data: 26/06/2019
 * Hora: 19:12
 */

namespace Model;

/**
 * @Entity
 * @Table(name="noticias_imagens")
 */
class NoticiaImagem{

    const TIPO_NORMAL = 1;
    const TIPO_CAPA = 2;

    /**
     * @Id
     * @Column(name="not_img_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     *@Column(name="not_img_titulo_imagem", type="string")
     */
    protected $tituloImagem;

    /**
     * @ManyToOne(targetEntity="Imagem")
     * @JoinColumn(name="imagem_id", referencedColumnName="img_id", nullable=false)
     */
    private $imagem;

    /**
     * @ManyToOne(targetEntity="Noticia")
     * @JoinColumn(name="noticia_id", referencedColumnName="not_id", nullable=false)
     */
    private $noticia;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTituloImagem()
    {
        return $this->tituloImagem;
    }

    public function setTituloImagem($tituloImagem)
    {
        $this->tituloImagem = $tituloImagem;
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
    public function getNoticia()
    {
        return $this->noticia;
    }

    /**
     * @param mixed $noticia
     */
    public function setNoticia($noticia)
    {
        $this->noticia = $noticia;
    }
}