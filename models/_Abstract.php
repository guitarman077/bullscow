<?php

namespace Models;

abstract class _Abstract
{
    /** @var string Название таблицы */
    protected static $_table_name;

    /** @var array Здесь будут хранится свойста модели */
    protected $_attributes = array();

    /**
     * @param array $params key-value array
     */
    public function __construct(Array $params)
    {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }
}