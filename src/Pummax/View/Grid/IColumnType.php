<?php


namespace Pummax\View\Grid;


use Pummax\Interfaces\IArrayFormat;

interface IColumnType extends IArrayFormat
{

    const TYPE_TEXT = 'text';
    const TYPE_LIST = 'list';
    const TYPE_DATE = 'date';
    const TYPE_DATE_TIME = 'dateTime';
    const TYPE_NUMBER = 'number';
    const TYPE_BOOLEAN = 'boolean';

}