<?php
/**
 * Criado: Fernando Cristen
 * Data: 03/09/2019
 * Hora: 22:51
 */

namespace Pummax\View;


use Pummax\Controller\BaseController;

/**
 * Class BaseFormView
 * Usado em todos os forms do admin.
 * @package Pummax\View
 */
abstract class BaseFormView extends BaseController
{
    private $router;

    private $html;

    private $dados;

    private $isView;

    private $isEdit;

    abstract public function createHtml();

    public function __construct($router, $isView = false, $isEdit = false)
    {
        parent::__construct();
        $this->setRouter($router);
        $this->setIsView($isView);
        $this->setIsEdit($isEdit);
        $this->setHtml($this->createHtml());
    }

    public function getFormatoJSON(){
        echo json_encode([
            'html' => $this->getHtml(),
            'dados' => $this->getDados(),
            'isView' => $this->getisView(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param mixed $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }

    /**
     * @return mixed
     */
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * @param mixed $dados
     */
    public function setDados($dados)
    {
        $this->dados = $dados;
    }

    /**
     * @return mixed
     */
    public function getisView()
    {
        return $this->isView;
    }

    /**
     * @param mixed $isView
     */
    public function setIsView($isView)
    {
        $this->isView = $isView;
    }

    /**
     * @return mixed
     */
    public function getisEdit()
    {
        return $this->isEdit;
    }

    /**
     * @param mixed $isEdit
     */
    public function setIsEdit($isEdit)
    {
        $this->isEdit = $isEdit;
    }


}