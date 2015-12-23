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

    /**
     * Основной метод игры
     *
     * @return string
     * @throws \Exception
     */
    public function indexAction()
    {
        $tel = $_REQUEST['tel'];
        $msg = strtolower($_REQUEST['msg']);

        if (empty($tel) || empty($msg)) {
            throw new \Exception("Invalid http request", 404);
        }

        /** @var $user User*/
        $user = User::getByLogin($tel);

        /** @var $game Game */
        $game = Game::getByUserId($user->id);

        if(empty($game)) {
            throw new \Exception("Game not initialized", 404);
        }

        /** @var $results Array результаты ответа*/
        $results = BullsCow::processAnswer($game, $msg);

        return $this->render('index/index.php', array(
            'results' => $results
        ));
    }

    /**
     * Требуется для иницилизации новой игры
     *
     * @return string
     * @throws \Exception
     */
    public function startAction()
    {
        $tel = $_REQUEST['tel'];

        if (empty($tel)) {
            throw new \Exception("Invalid http request", 404);
        }

        /** @var $user User*/
        $user = User::getByLogin($tel);

        /** @var  $game */
        $game = BullsCow::initGame($user->id);

        if (empty($game)) {
            throw new \Exception("Game init error ", 404);
        }

        return $this->render('index/start.php');
    }

}