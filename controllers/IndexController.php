<?php
namespace Controllers;
use Models\Game;
use Models\User;
use Components\BullsCow;

/**
 * Class IndexController
 * @package Controllers
 */
class IndexController extends _Abstract {

    public function indexAction()
    {
        $tel = $_REQUEST['tel'];
        $msg = strtolower($_REQUEST['msg']);

        if (empty($tel) || empty($msg)) {
            throw new \Exception("Invalid http request", 404);
        }

        /** @var $user User*/
        $user = User::getByLogin($tel);

        $params = array();

        if (strtolower($msg) == "start") { // Пользователь начинает новую игру
            $game = BullsCow::initGame($user->id);

            if (empty($game)) {
                throw new \Exception("Game init error ", 404);
            }

            $view = 'start.php';
        } else {

            /** @var $game Game */
            $game = Game::getByUserId($user->id);

            $params['results'] = BullsCow::processAnswer($game, $msg);

            $view = 'index.php';
        }

        echo $this->render('index/' . $view, $params);
    }

}