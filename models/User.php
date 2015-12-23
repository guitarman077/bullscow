<?php

namespace Models;

use Components\DB;

class User extends _Abstract
{
    protected static $_table_name = 'users';

    /**
     * @param $login
     * @return static
     */
    public static function getByLogin($login)
    {
        $_user = static::_get($login);

        if (!$_user) { // если пользователя нет в бд создаем
           $_user = static::create($login);
        }

        return new static($_user);
    }

    /**
     * Получаем пользователя из БД, false - если пользователя нет
     *
     * @param $login
     * @return mixed
     */
    private static function _get($login)
    {
        /** @var $db \PDO*/
        $db = DB::getInstance();

        /** @var $result \PDOStatement*/
        $result = $db->query('SELECT * FROM ' . static::$_table_name .' WHERE login = ' . $login);

        return $result->fetch($db::FETCH_ASSOC);
    }


    /**
     * Создает пользователя
     *
     * @param $login
     * @return array
     */
    private static function create($login)
    {
        /** @var $db \PDO*/
        $db = DB::getInstance();

        $db->exec('
                INSERT INTO ' . static::$_table_name . ' (login) VALUES ("' . $login . '");
            ');

        return array(
            'id' => $db->lastInsertId(),
            'login' => $login,
        );
    }
}