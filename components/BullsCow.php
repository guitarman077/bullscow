<?php

namespace Components;

use Models\Game;

class BullsCow extends _Abstract
{
    /** @const количество цифр */
    const MAX_LENGTH = 4;

    /**
     * Начинает новую игру
     *
     * @param $user_id
     * @return static
     */
    public static function initGame($user_id)
    {
        return Game::create($user_id, static::prepareTask());
    }

    /**
     * Возвращает строку из 4-х уникальных чисел
     *
     * @return string
     */
    private static function prepareTask()
    {
        $return = array();

        while(count($return) < static::MAX_LENGTH) {

            $rand = mt_rand(1, 9);

            if (isset($return[$rand])) {
                continue;
            }

            $return[$rand] = $rand;
        }

        return implode('', $return);
    }

    /**
     * Обрабатывает ответ (Считает быков и коров)
     *
     * @param Game $game
     * @param $answer
     * @return array
     */
    public static function processAnswer(Game $game, $answer)
    {
        /** @var $bulls int Количество быков*/
        $bulls = 0;

        /** @var $cow int Количество коров*/
        $cow = 0;

        for ($i = 0; $i < mb_strlen($answer); $i++) {

            if (mb_strpos($game->task, $answer[$i]) === $i) {
                $bulls++;
            } elseif (mb_strpos($game->task, $answer[$i]) !== false) {
                $cow++;
            }
        }

        return array(
            'bulls' => $bulls,
            'cow' => $cow,
        );
    }
}