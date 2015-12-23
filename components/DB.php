<?php

namespace Components;

/**
 * Точка доступа к БД
 *
 * Class DB
 * @package Components
 */
class DB extends _Abstract
{

    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new \PDO('mysql:host=localhost;dbname=bulls-cow', 'root', '');
        }

        return static::$instance;
    }

    private function __clone() {}
    private function __sleep() {}
    private function __wakeup() {}
}