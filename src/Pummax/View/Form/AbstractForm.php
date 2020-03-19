<?php


namespace Pummax\View\Form;


use Pummax\Controller\BaseController;

abstract class AbstractForm extends BaseController
{

    protected $isView;

    protected $html;

    protected $dataMappingArray;

    protected $buttons;

    public function __construct($isView = false)
    {
        parent::__construct();
        $this->html = $this->createHtml();
        $this->isView = $isView;
        $this->dataMappingArray = $this->getDataMapping();
    }

    /**
     * @return string
     */
    public abstract function createHtml();

    /**
     * @return array
     */
    public abstract function getDataMapping();

    /**
     * @return string
     */
    public abstract function getFormName();

    public function addButtons(){
        if($this->isView()){
            $this->addButton(new Button('Fechar', 'controller.cancelar()', 'btn-info'));
        }else{
            $this->addButton(new Button('Cancelar', 'controller.cancelar()', 'btn-danger'));
            $this->addButton(new Button('Confirmar', 'controller.confirmar()', 'btn-primary'));
        }
    }

    /**
     * @return bool
     */
    public function isView()
    {
        return $this->isView;
    }

    /**
     * @param bool $isView
     */
    public function setIsView($isView)
    {
        $this->isView = $isView;
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
    public function getButtons()
    {
        if(!$this->buttons){
            $this->addButtons();
        }
        return $this->buttons;
    }

    /**
     * @param mixed $buttons
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * @param Button $button
     */
    public function addButton(Button $button)
    {
        $this->buttons[] = $button;
    }

    /**
     * @return mixed
     */
    public function getDataMappingArray()
    {
        return $this->dataMappingArray;
    }

    /**
     * @param mixed $dataMappingArray
     */
    public function setDataMappingArray($dataMappingArray)
    {
        $this->dataMappingArray = $dataMappingArray;
    }


}