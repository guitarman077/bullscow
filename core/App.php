<?php

class App
{
    private function __construct() {}

    /**
     * ЗАПУСКАЕТ ПРИЛОЖЕНИЕ
     */
    public static function run()
    {
        static::_require();

        /** @var $controller \Controllers\_Abstract*/
        $controller = static::getController();

        echo $controller->{static::getAction()}();
    }

    /**
     * Подключает необходимые файлы файлы
     */
    private static function _require()
    {
        $files = array(
            'Controllers/_Abstract.php',
            'Controllers/IndexController.php',
            'Components/_Abstract.php',
            'Components/BullsCow.php',
            'Components/DB.php',
            'models/_Abstract.php',
            'models/Game.php',
            'models/User.php',
        );

        foreach ($files as $file) {
            require_once $file;
        }
    }

    /**
     * Возвращает контроллер
     *
     * @return \Controllers\_Abstract
     */
    private static function getController()
    {
        $controller = CONTROLLER_NAMESPACE . DEFAULT_CONTROLLER;

        return new $controller;
    }

    /**
     * Получаем действие
     *
     * @return string
     */
    private static function getAction()
    {
        $action = isset($_GET[ACTION_PARAM]) ? $_GET[ACTION_PARAM] : DEFAULT_ACTION;

        return $action . 'Action';
    }
}