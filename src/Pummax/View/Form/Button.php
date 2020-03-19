<?php


namespace Pummax\View\Form;


use Pummax\Interfaces\IArrayFormat;

class Button implements IArrayFormat
{
    protected $title;

    protected $class;

    protected $icon;

    protected $function;

    /**
     * Button constructor.
     * @param $title
     * @param $class
     * @param $icon
     * @param $function
     */
    public function __construct($title, $function, $class = 'btn-primary', $icon = '')
    {
        $this->title = $title;
        $this->function = $function;
        $this->class = $class;
        $this->icon = $icon;
    }

    public function getArrayFormat()
    {
        return [
            'title' => $this->title,
            'function' => $this->function,
            'class' => $this->class,
            'icon' => $this->icon,
        ];
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param mixed $function
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }

}