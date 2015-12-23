<?php

namespace Models;

use Components\DB;

class Game extends _Abstract
{
    protected static $_table_name = 'games';

    /**
     * Метод создающий новую игру
     *
     * @param $user_id
     * @param $task
     * @return static
     */
    public static function create($user_id, $task)
    {
        /** @var $db \PDO*/
        $db = Db::getInstance();

        $db->exec('
            INSERT INTO ' . static::$_table_name .' (user_id, task)
            VALUES (' . $user_id . ', ' . $task . ');
        ');

        $insert_id = $db->lastInsertId();

        return new static(array(
            'id' => $insert_id,
            'user_id' => $user_id,
            'task' => $task,
        ));
    }

    /**
     * Получаем пользователя
     *
     * @param $user_id
     * @return static
     */
    public static function getByUserId($user_id)
    {
        /** @var $db \PDO*/
        $db = Db::getInstance();

        /** @var $result \PDOStatement*/
        $result = $db->query('
          SELECT * FROM ' . static::$_table_name . ' WHERE user_id = ' . $user_id
        );

        $game = $result->fetch();

        if (empty($game)) {
            return false;
        }

        return new static(array(
            'id' => $game['id'],
            'user_id' => $user_id,
            'status' => $game['status'],
            'task' => $game['task'],
        ));
    }
}