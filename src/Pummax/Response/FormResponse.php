<?php


namespace Pummax\Response;


use Pummax\Util\Json;
use Pummax\View\Form\AbstractForm;
use Pummax\View\Form\Button;

class FormResponse extends BaseResponse
{
    protected $html;

    protected $data;

    protected $buttons;

    /**
     * FormResponse constructor.
     * @param $view
     * @param $data
     * @param $buttons Button[]
     */
    public function __construct(AbstractForm $view, $buttons, $data = [])
    {
        $this->html = $view->getHtml();
        $this->data = $data;
        $this->data['maximized'] = $view->getMaximized();
        $this->data['isView'] = $view->isView();
        if($view->getScopeData()){
            foreach ($view->getScopeData() as $key => $value){
                $this->data['params'][$key] = $value;
            }
        }
        $this->data['params']['isEdit'] = $view->isEdit();
        $buttonsArray = [];
        foreach ($buttons as $button){
            $buttonsArray[] = $button->getArrayFormat();
        }
        $this->buttons = $buttonsArray;
        $this->type = self::TYPE_FROM;
    }


    public function getJsonFormat()
    {
        return Json::encode([
            'data' => $this->getData(),
            'html' => $this->getHtml(),
            'buttons' => $this->getButtons(),
            'type' => $this->getType(),
        ]);
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @param mixed $buttons
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
    }

}